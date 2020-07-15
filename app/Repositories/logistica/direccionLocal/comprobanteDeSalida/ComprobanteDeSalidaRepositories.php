<?php
namespace App\Repositories\logistica\direccionLocal\comprobanteDeSalida;
// Models
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Repositories
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
use App\Repositories\logistica\direccionLocal\EstatusDireccionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ComprobanteDeSalidaRepositories implements ComprobanteDeSalidaInterface {
  protected $serviceCrypt;
  protected $metodoDeEntregaRepo;
  protected $estatusDireccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, MetodoDeEntregaRepositories $metodoDeEntregaRepositories, EstatusDireccionRepositories $estatusDireccionRepositories) {
    $this->serviceCrypt         = $serviceCrypt;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
    $this->estatusDireccionRepo = $estatusDireccionRepositories;
  }
  public function comprobanteFindOrFailById($id_comprobante, $relaciones) {
    $id_comprobante = $this->serviceCrypt->decrypt($id_comprobante);
    $comprobante = PedidoArmadoDireccionTieneComprobante::with($relaciones)->where('estat', '!=', config('app.entregado'))->findOrFail($id_comprobante);
    return $comprobante;
  }
  public function store($request, $id_direccion) {
    try { DB::beginTransaction();
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailByNombreMetodo($request->metodo_de_entrega, []);
      $comprobante                            = new PedidoArmadoDireccionTieneComprobante();
      $comprobante->cant                      = $request->cantidad;
      $comprobante->met_de_entreg_de_log      = $metodo_de_entrega->nom_met_ent;
      $comprobante->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_espesifico;
      $comprobante->direccion_id              = $id_direccion;
      $comprobante->comp_de_sal_rut           = 'public/comprobantes_de_salida/'.date("Y").'/'.$comprobante->direccion_id.'/';
      $comprobante->comp_de_sal_nom           = 'comprobante_de_salida-'.time().'.jpg';
      $comprobante->created_at_comp           = Auth::user()->email_registro;  
      $comprobante_de_salida = $request->file('comprobante_de_salida');
      $comprobante_de_salida->storeAs($comprobante->comp_de_sal_rut, $comprobante->comp_de_sal_nom);
      $comprobante->save();

      $this->estatusDireccionRepo->estatusDireccion($id_direccion);

      DB::commit();
      return $comprobante;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
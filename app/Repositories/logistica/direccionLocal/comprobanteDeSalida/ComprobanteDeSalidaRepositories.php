<?php
namespace App\Repositories\logistica\direccionLocal\comprobanteDeSalida;
// Models
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Events
use App\Events\layouts\ActividadRegistrada;
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
      $comprobante                            = new PedidoArmadoDireccionTieneComprobante();
      $comprobante->cant                      = $request->cantidad;
      $comprobante->met_de_entreg_de_log      = $request->metodo_de_entrega;
      $comprobante->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_espesifico;
      $comprobante->direccion_id              = $id_direccion;
      $comprobante->comp_de_sal_rut           = 'public/comprobantes_de_salida/'.date("Y").'/'.$comprobante->direccion_id.'/';
      $comprobante->comp_de_sal_nom           = 'comprobante_de_salida-'.time().'.jpg';
      $comprobante->created_at_comp           = Auth::user()->email_registro;
      if($request->hasfile('comprobante_de_salida')) {
        $comprobante_de_salida = $request->file('comprobante_de_salida');
        $comprobante_de_salida->storeAs($comprobante->comp_de_sal_rut, $comprobante->comp_de_sal_nom);
      }
      $comprobante->save();

      $this->estatusDireccionRepo->estatusDireccion($id_direccion);

      DB::commit();
      return $comprobante;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_comprobante) {
    try { DB::beginTransaction();
      $comprobante = $this->comprobanteFindOrFailById($this->serviceCrypt->encrypt($id_comprobante), []);
      $comprobante->cant                      = $request->cantidad;
      $comprobante->met_de_entreg_de_log      = $request->metodo_de_entrega;
     
      if($comprobante->met_de_entreg_de_log == 'Paquetería' OR $comprobante->met_de_entreg_de_log == 'Transporte interno de la empresa' OR $comprobante->met_de_entreg_de_log == 'Transportes Ferro' OR $comprobante->met_de_entreg_de_log == 'Viaje metropolitano (Uber, Didi, Beat...)') {
        $comprobante->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_espesifico;
      } else {
        $comprobante->met_de_entreg_de_log_esp = null;
      }
      
      if($comprobante->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Direcciones locales', // Módulo
          'logistica.direccionLocal.comprobanteDeSalida.show', // Nombre de la ruta
          $this->serviceCrypt->encrypt($comprobante->id), // Id del registro debe ir encriptado
          $comprobante->id, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Cantidad', 'Método de entrega', 'Método de entrega espesifico'), // Nombre de los inputs del formulario
          $comprobante, // Request
          array('cant', 'met_de_entreg_de_log', 'met_de_entreg_de_log_esp') // Nombre de los campos en la BD
        ); 
        $comprobante->updated_at_comp  = Auth::user()->email_registro;
      }

      if($request->hasfile('comprobante_de_salida')) {
        \Storage::delete($comprobante->comp_de_sal_rut.$comprobante->comp_de_sal_nom);
        $comprobante->comp_de_sal_rut           = 'public/comprobantes_de_salida/'.date("Y").'/'.$comprobante->direccion_id.'/';
        $comprobante->comp_de_sal_nom           = 'comprobante_de_salida-'.time().'.jpg';
        $comprobante_de_salida = $request->file('comprobante_de_salida');
        $comprobante_de_salida->storeAs($comprobante->comp_de_sal_rut, $comprobante->comp_de_sal_nom);
      }
      $comprobante->save();

      $this->estatusDireccionRepo->estatusDireccion($comprobante->direccion_id);

      DB::commit();
      return $comprobante;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
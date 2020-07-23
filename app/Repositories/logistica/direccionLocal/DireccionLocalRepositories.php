<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\logistica\direccionLocal\EstatusArmadoRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaEspecificoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  protected $estatusArmadoRepo;
  protected $metodoDeEntregaEspecificoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, EstatusArmadoRepositories $estatusArmadoRepositories, MetodoDeEntregaEspecificoRepositories $metodoDeEntregaEspecificoRepositories) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->estatusArmadoRepo              = $estatusArmadoRepositories;
    $this->metodoDeEntregaEspecificoRepo  = $metodoDeEntregaEspecificoRepositories;
  }
  public function direccionLocalFindOrFailById($id_direccion, $for_loc, $relaciones, $accion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->where('for_loc', $for_loc);
    if($accion == 'edit') {
      $direccion->where(function ($query) {$query->where('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      });
    }
    return $direccion->findOrFail($id_direccion);
  }
  public function getPagination($request, $for_loc, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->where('for_loc', $for_loc)
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('id', 'DESC')
    ->paginate($request->paginador);
  }
  public function store($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion                            = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), config('opcionesSelect.select_foraneo_local.Local'), ['armado'], 'edit');
      $metodo_de_entrega_espesifico         = $this->metodoDeEntregaEspecificoRepo->metodoEspecificoFirstByNombreMetodo($request->metodo_de_entrega_espesifico, []);
    
      if($metodo_de_entrega_espesifico == null) {
        $url = null;
      }else {
        $url = $metodo_de_entrega_espesifico->url;
      }
    
      $direccion->estat                     = config('app.en_ruta');
      $direccion->met_de_entreg_de_log      = $request->metodo_de_entrega;
      $direccion->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_espesifico;
      $direccion->url                       = $url;
      $direccion->cost_por_env_log          = $request->costo_por_envio;

      $direccion->created_com_sal           = Auth::user()->email_registro;
      if($request->hasfile('comprobante_de_salida')) {
        $direccion->comp_de_sal_rut   = 'public/comprobante/'.date("Y").'/'.$direccion->id.'/';
        $direccion->comp_de_sal_nom   = 'comprobante_de_salida-'.time().'.jpg';
        $comprobante_de_salida        = $request->file('comprobante_de_salida');
        $comprobante_de_salida->storeAs($direccion->comp_de_sal_rut, $direccion->comp_de_sal_nom);
      }
      $direccion->save();

      $this->estatusArmadoRepo->estatusArmado($direccion);

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeEntrega($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion        = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), config('opcionesSelect.select_foraneo_local.Local'), [], 'edit');
      $direccion->estat = config('app.entregado');
      $direccion->save();

      $this->estatusArmadoRepo->estatusArmado($direccion);

      // GUARDA LA IMAGEN DEL COMRPBANTE
      $comprobante = new PedidoArmadoDireccionTieneComprobante();
      $comprobante->num_guia        = $request->numero_de_guia;
      $comprobante->direccion_id    = $id_direccion;
      $comprobante->created_at_comp = Auth::user()->email_registro;

      if($request->hasfile('comprobante_de_entrega')) {
        \Storage::delete($comprobante->comp_ent_rut.$comprobante->comp_ent_nom);
        $comprobante->comp_ent_rut           = 'public/comprobante/'.date("Y").'/'.$direccion->id.'/';
        $comprobante->comp_ent_nom           = 'comprobante_de_entrega-'.time().'.jpg';
        $comprobante_de_entrega = $request->file('comprobante_de_entrega');
        $comprobante_de_entrega->storeAs($comprobante->comp_ent_rut, $comprobante->comp_ent_nom);
      }

      $comprobante->save();   

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones) {
    $up_estaus     = NULL;
    $ids           = NULL;
    $nom_tabla = (new PedidoArmadoTieneDireccion())->getTable();

    foreach($direcciones as $direccion) {
      $up_estaus  .= ' WHEN '. $direccion->id. ' THEN "'. config('app.en_almacen_de_salida').'"';
      $ids        .= $direccion->id.',';
    }

    if($up_estaus != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estaus." END WHERE id IN (".$ids.")");
    }
  }
}
<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Notifications
use App\Notifications\logistica\NotificacionPedidoEntregado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\logistica\direccionLocal\EstatusArmadoRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaEspecificoRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  protected $estatusArmadoRepo;
  protected $metodoDeEntregaEspecificoRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, EstatusArmadoRepositories $estatusArmadoRepositories, MetodoDeEntregaEspecificoRepositories $metodoDeEntregaEspecificoRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->estatusArmadoRepo              = $estatusArmadoRepositories;
    $this->metodoDeEntregaEspecificoRepo  = $metodoDeEntregaEspecificoRepositories;
    $this->plantillaRepo                  = $plantillaRepositories;
    $this->sistemaRepo                    = $sistemaRepositories;
  }
  public function direccionLocalFindOrFailById($id_direccion, $for_loc, $relaciones, $accion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones);
    
    if($for_loc != null) {
      $direccion->where('for_loc', $for_loc);
    }
    if($accion == 'edit') {
      $direccion->where('regresado', 'falso')
      ->where(function ($query) {
        $query->where('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      });
    }
    return $direccion->findOrFail($id_direccion);
  }
  public function getPagination($request, $for_loc, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg');
      }]);
    }])
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
      $direccion                            = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), null, ['armado'], 'edit');
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
      $direccion->fech_car_comp_de_sal      = date('Y-m-d h:i:s');

      if($request->hasfile('comprobante_de_salida')) {
        \Storage::delete($direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom);
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
      $direccion        = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), null, ['armado'], 'edit');
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

      $cliente = $direccion->armado->pedido->usuario;
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_ped_ent'));
      $cliente->notify(new NotificacionPedidoEntregado($cliente, $plantilla, $direccion->armado->cod)); // Envió de correo electrónico

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion        = $this->direccionLocalFindOrFailById($id_direccion, null, ['armado'], 'show');
      if($request->estatus == config('app.sin_entrega_por_falta_de_informacion') OR $request->estatus == config('app.intento_de_entrega_fallido')) {
        $direccion->estat = $request->estatus;
        $direccion->save();
        $this->estatusArmadoRepo->estatusArmado($direccion);
      } else {
        $this->estatusArmadoRepo->regresarAProduccion($direccion->armado);
      }
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones) {
    $up_estaus     = NULL;
    $up_regresados = null;
    $ids           = NULL;
    $nom_tabla = (new PedidoArmadoTieneDireccion())->getTable();

    foreach($direcciones as $direccion) {
      if($direccion->estat == config('app.pendiente')) {
        $up_estaus  .= ' WHEN '. $direccion->id. ' THEN "'. config('app.en_almacen_de_salida').'"';
        $ids        .= $direccion->id.',';
      } else {
        $up_regresados  .= ' WHEN '. $direccion->id. ' THEN "false"';
        $ids        .= $direccion->id.',';
      }
    }

    if($up_estaus != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estaus." END WHERE id IN (".$ids.")");
    }
    if($up_regresados != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET regresado = CASE id". $up_regresados." END WHERE id IN (".$ids.")");
    }
  }
}
<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Repositories
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->serviceCrypt         = $serviceCrypt;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
  }
  public function direccionLocalFindOrFailById($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->where('for_loc', config('opcionesSelect.select_foraneo_local.Local'))->where(function ($query) {
      $query->where('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })->findOrFail($id_direccion);
    return $direccion;
  }
  public function getPagination($request, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->where('for_loc', config('opcionesSelect.select_foraneo_local.Local'))
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
  public function storeComprobanteDeSalida($request, $id_direccion) {
    try { DB::beginTransaction();
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailById($this->serviceCrypt->encrypt($request->metodo_de_entrega), []);
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

      $this->estatusDireccion($id_direccion);

      DB::commit();
      return $comprobante;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones) {
    $up_estaus     = NULL;
    $ids                    = NULL;
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
  public function estatusDireccion($id_direccion) {
    $nom_tabla = (new \App\Models\PedidoArmadoDireccionTieneComprobante())->getTable();
    $direccion = PedidoArmadoTieneDireccion::with('armado')->findOrFail($id_direccion);

    $consulta = DB::table($nom_tabla)->select(
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE direccion_id = $direccion->id AND estat = '".config('app.en_ruta')."') as en_ruta"),
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE direccion_id = $direccion->id AND estat = '".config('app.intento_de_entrega_fallido')."') as intento_de_entrega_fallido"),
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE direccion_id = $direccion->id AND estat = '".config('app.sin_entrega_por_falta_de_informacion')."') as sin_entrega_por_falta_de_informacion"),
      DB::raw("(SELECT SUM(cant) FROM $nom_tabla WHERE direccion_id = $direccion->id AND estat = '".config('app.en_ruta')."') as suma_en_ruta"),
      DB::raw("(SELECT SUM(cant) FROM $nom_tabla WHERE direccion_id = $direccion->id AND estat = '".config('app.entregado')."') as suma_entregado")
    )->first();

    $anteriores = $consulta->en_ruta + $consulta->intento_de_entrega_fallido + $consulta->sin_entrega_por_falta_de_informacion;
    if($anteriores == 0 AND $consulta->suma_entregado == $direccion->cant) {
      $estatus = config('app.entregado');
    }
    if($consulta->en_ruta > 0) {
      $estatus = config('app.en_ruta');
    }
    if($consulta->suma_en_ruta != $direccion->cant) {
      $estatus = config('app.en_almacen_de_salida');
    }
    if($consulta->intento_de_entrega_fallido > 0) {
      $estatus = config('app.intento_de_entrega_fallido');
    }
    if($consulta->sin_entrega_por_falta_de_informacion > 0) {
      $estatus = config('app.sin_entrega_por_falta_de_informacion');
    }
    if(empty($estatus)) {
      return abort(500, 'Algo salio mal en el estatus de la dirección');
    }

    $direccion->estat = $estatus;
    $direccion->save();

    $this->estatusArmado($direccion);

    return $direccion;
  }
  public function estatusArmado($direccion) {
    $nom_tabla = (new \App\Models\PedidoArmadoTieneDireccion())->getTable();

    $consulta_armado = DB::table($nom_tabla)->select(
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE pedido_armado_id = $direccion->pedido_armado_id AND estat = '".config('app.en_ruta')."') as en_ruta"),
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE pedido_armado_id = $direccion->pedido_armado_id AND estat = '".config('app.intento_de_entrega_fallido')."') as intento_de_entrega_fallido"),
      DB::raw("(SELECT COUNT(*) FROM $nom_tabla WHERE pedido_armado_id = $direccion->pedido_armado_id AND estat = '".config('app.sin_entrega_por_falta_de_informacion')."') as sin_entrega_por_falta_de_informacion"),
      DB::raw("(SELECT SUM(cant) FROM $nom_tabla WHERE pedido_armado_id = $direccion->pedido_armado_id AND estat = '".config('app.en_ruta')."') as suma_en_ruta"),
      DB::raw("(SELECT SUM(cant) FROM $nom_tabla WHERE pedido_armado_id = $direccion->pedido_armado_id AND estat = '".config('app.entregado')."') as suma_entregado")
    )->first();

    $anteriores = $consulta_armado->en_ruta + $consulta_armado->intento_de_entrega_fallido + $consulta_armado->sin_entrega_por_falta_de_informacion;
    if($anteriores == 0 AND $consulta_armado->suma_entregado == $direccion->armado->cant) {
      $estatus_armado = config('app.entregado');
    }
    if($consulta_armado->en_ruta > 0) {
      $estatus_armado = config('app.en_ruta');
    }
    if($consulta_armado->suma_en_ruta != $direccion->armado->cant) {
      $estatus_armado = config('app.en_almacen_de_salida');
    }
    if($consulta_armado->intento_de_entrega_fallido > 0) {
      $estatus_armado = config('app.intento_de_entrega_fallido');
    }
    if($consulta_armado->sin_entrega_por_falta_de_informacion > 0) {
      $estatus_armado = config('app.sin_entrega_por_falta_de_informacion');
    }
    if(empty($estatus_armado)) {
      return abort(500, 'Algo salio mal en el estatus del armado');
    }

    $direccion->armado->estat = $estatus_armado;
    $direccion->armado->save();

    \App\Models\Pedido::getEstatusPedido($direccion->armado->pedido, 'Todos');

    return $direccion->armado;
  }
}
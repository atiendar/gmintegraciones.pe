<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Otros
use DB;

class EstatusDireccionRepositories implements EstatusDireccionInterface {
  public function estatusDireccion($id_direccion) {
    $nom_tabla = (new PedidoArmadoDireccionTieneComprobante())->getTable();
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
    $nom_tabla = (new PedidoArmadoTieneDireccion())->getTable();

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
<?php
namespace App\Repositories\almacen\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function pedidoActivoAlmacenFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where(function ($query){
                $query->where('estat_alm', config('app.asignar_lider_de_pedido'))
                    ->orWhere('estat_alm', config('app.en_espera_de_ventas'))
                    ->orWhere('estat_alm', config('app.en_espera_de_compra'))
                    ->orWhere('estat_alm', config('app.en_revision_de_productos'));
                })->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) {
    return Pedido::with($relaciones)->where(function ($query){
                $query->where('estat_alm', config('app.asignar_lider_de_pedido'))
                    ->orWhere('estat_alm', config('app.en_espera_de_ventas'))
                    ->orWhere('estat_alm', config('app.en_espera_de_compra'))
                    ->orWhere('estat_alm', config('app.en_revision_de_productos'));
                })->buscar($request->opcion_buscador, $request->buscador)->orderBy('fech_estat_alm', 'DESC')->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $pedido                 = $this->pedidoActivoAlmacenFindOrFailById($id_pedido, []);
      $pedido->lid_de_ped_alm = $request->lider_de_pedido_almacen;
      $pedido->coment_alm     = $request->comentario_almacen;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Almacén (Pedidos activos)', // Módulo
          'almacen.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Líder de pedido almacén', 'Comentario almacén'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('lid_de_ped_alm', 'coment_alm') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Almacén');
      return $pedido;
    });
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($pedido->lid_de_ped_alm != null) {
      if($request->opcion_buscador != null) {
        return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
      }
      return $pedido->armados()->paginate($request->paginador);
    }
    return $pedido->armados()->where('id', '!"#$%&/()(/&%$')->paginate($request->paginador);
  }
  public function marcarTodoCompleto($id_pedido) {
    // CAMBIA EL ESTATUS LOS ARMADOS CON LOS ESTATUS ESPESIFICADOS Y AL FINAL CAMBIA EL ESTATUS (ALMACÉN) DEL PEDIDO
    try { DB::beginTransaction();
      $pedido = $this->pedidoActivoAlmacenFindOrFailById($id_pedido, ['armados']);
      if($pedido->lid_de_ped_alm == null) { return abort(405, 'Falta asignar líder de pedido'); }
      $armados = $pedido->armados()->where(function ($query){
                    $query->where('estat', config('app.en_espera_de_compra'))
                      ->orWhere('estat', config('app.en_revision_de_productos'));
                  })->get();
      $nom_tabla = (new \App\Models\PedidoArmado())->getTable();

      $hastaC                 = count($armados) - 1;
      $up_estatus_armado      = null;
      $up_updated_at_ped_arm  = null;
      $up_updated_at          = null;
      $ids                    = null;
      foreach($armados as $armado) {
        $up_estatus_armado      .= ' WHEN '. $armado->id. ' THEN "'. config('app.productos_completos'). '"';
        $up_updated_at_ped_arm  .= ' WHEN '. $armado->id. ' THEN "'. Auth::user()->email_registro.'"';
        $up_updated_at          .= ' WHEN '. $armado->id. ' THEN "'.date('Y-m-d h:i:s').'"';
        $ids                    .= $armado->id.',';
      }
      if($hastaC > 0) {
        $ids = substr($ids, 0, -1);
        DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estatus_armado." END, updated_at_ped_arm = CASE id". $up_updated_at_ped_arm." END, updated_at = CASE id". $up_updated_at." END WHERE id IN (".$ids.")");
      }

      Pedido::getEstatusPedido($pedido, 'Almacén');
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
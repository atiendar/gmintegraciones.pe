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
  public function pedidoActivoAsignadoFindOrFailById($id_pedido) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->with('armados')
    ->where(function ($query){
      $query->where('estat_alm', config('app.asignar_lider_de_pedido'))
        ->orWhere('estat_alm', config('app.en_espera_de_compra'))
        ->orWhere('estat_alm', config('app.en_revision_de_productos'))
        ->orWhere('estat_alm', config('app.productos_completos_terminado'));
    })->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request) {
    return Pedido::with('usuario')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)
    ->where(function ($query){
      $query->where('estat_alm', config('app.asignar_lider_de_pedido'))
        ->orWhere('estat_alm', config('app.en_espera_de_compra'))
        ->orWhere('estat_alm', config('app.en_revision_de_productos'))
        ->orWhere('estat_alm', config('app.productos_completos_terminado'));
    })->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $pedido = $this->pedidoActivoAsignadoFindOrFailById($id_pedido);
      $pedido->lid_de_ped_alm    = $request->lider_de_pedido_almacen;
      $pedido->coment_alm        = $request->comentario_almacen;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pedidos', // Módulo
          'almacen.pedidoAlmacen.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_pedido), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Lider de pedido almacen', 'Comentario almacen'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('lid_de_ped_alm', 'coment_alm') // Nombre de los campos en la BD
        ); 
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      return $pedido;
    });
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getArmadosPedido($pedido){
    $armados=$pedido->armados()->with('productos');
    return $armados;
  }
  public function getArmadoPedidoTieneProductosPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->productos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->productos()->paginate($request->paginador);
  }
}
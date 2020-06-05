<?php
namespace App\Repositories\almacen\pedidoTerminado;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function pedidoTerminadoFindOrFailById($id_pedido) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with('armados')
    ->where('estat_alm', config('app.productos_completos_terminado'))
    ->whereBetween('fech_estat_alm', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) {
    return Pedido::with($relaciones)
    ->where('estat_alm', config('app.productos_completos_terminado'))
    ->whereBetween('fech_estat_alm', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_alm', 'DESC')->paginate($request->paginador);
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
}

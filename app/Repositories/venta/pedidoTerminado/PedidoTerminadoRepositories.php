<?php
namespace App\Repositories\venta\pedidoTerminado;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function pedidoTerminadoFindOrFailById($id_pedido) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with('armados')
    ->where('estat_log', config('app.entregado'))
    ->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) {
    return Pedido::with($relaciones)
    ->where('estat_log', config('app.entregado'))
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_log', 'DESC')->paginate($request->paginador);
  }
}

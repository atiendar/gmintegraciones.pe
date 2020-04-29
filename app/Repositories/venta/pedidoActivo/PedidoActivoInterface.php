<?php
namespace App\Repositories\venta\pedidoActivo;

interface PedidoActivoInterface {
  public function pedidoAsignadoFindOrFailById($id_pedido);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_pedido);

  public function destroy($id_pedido);

  public function getArmadosPedidoPagination($pedido, $request);

  public function getPagosPedidoPagination($pedido, $request);

  public function updateTotalDeArmados($request, $id_pedido);

  public function updateMontoTotal($request, $id_pedido);
}
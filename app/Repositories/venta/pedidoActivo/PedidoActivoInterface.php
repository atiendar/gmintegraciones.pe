<?php
namespace App\Repositories\venta\pedidoActivo;

interface PedidoActivoInterface {
  public function pedidoAsignadoFindOrFailById($id_pedido, $relaciones);

  public function getPagination($request, $relaciones);

  public function update($request, $id_pedido);

  public function destroy($id_pedido);

  public function getArmadosPedidoPagination($pedido, $request);

  public function getPagosPedidoPagination($pedido, $request);

}
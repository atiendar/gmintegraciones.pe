<?php
namespace App\Repositories\logistica\pedidoActivo\local;

interface PedidoActivoInterface {
  public function getPagination($request, $relaciones);
  
  public function pedidoActivoLogisticaFindOrFailById($id_pedido, $relaciones);

  public function update($request, $id_pedido);
  
  public function getArmadosPedidoPaginate($pedido, $request);
}
<?php
namespace App\Repositories\logistica\pedidoActivoLocal;

interface PedidoActivoInterface {
  public function getPagination($request, $relaciones);
  
  public function pedidoActivoProduccionFindOrFailById($id_pedido, $relaciones);

  public function update($request, $id_pedido);
  
  public function getArmadosPedidoPaginate($pedido, $request);
}
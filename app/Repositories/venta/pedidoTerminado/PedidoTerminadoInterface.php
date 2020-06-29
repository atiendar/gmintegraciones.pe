<?php
namespace App\Repositories\venta\pedidoTerminado;

interface PedidoTerminadoInterface {
  public function pedidoTerminadoFindOrFailById($id_pedido);
  
  public function getPagination($request, $relaciones);
}

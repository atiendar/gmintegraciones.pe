<?php
namespace App\Repositories\venta\pedidoActivo\pagoPedidoActivo;

interface PagoPedidoActivoInterface {
  public function store($request, $id_pedido);
}
<?php
namespace App\Repositories\venta\rastrearPedido;

interface RastrearPedidoInterface {
    public function rastrear($id_pedido);
}
<?php
namespace App\Repositories\almacen\pedidoActivo;

interface PedidoActivoInterface {
    public function pedidoActivoAsignadoFindOrFailById($id_pedido);

    public function getPagination($request);

    public function update($request, $id_pedido);

    public function getArmadosPedidoPaginate($pedido, $request);

    public function getArmadosPedido($pedido);

    public function getArmadoPedidoTieneProductosPaginate($pedido, $request);

}
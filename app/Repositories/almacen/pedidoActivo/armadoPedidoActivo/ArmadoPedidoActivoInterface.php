<?php
namespace App\Repositories\almacen\pedidoActivo\armadoPedidoActivo;

interface ArmadoPedidoActivoInterface {
    public function armadoPedidoActivoFindOrFailById($id_armado);

    public function update($request, $id_armado);

    public function armadosTerminadosAlmacen($id_pedido);

}
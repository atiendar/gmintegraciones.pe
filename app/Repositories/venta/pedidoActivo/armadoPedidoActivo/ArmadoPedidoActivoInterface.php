<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo;

interface ArmadoPedidoActivoInterface {
  public function armadoFindOrFailById($id_armado);
}
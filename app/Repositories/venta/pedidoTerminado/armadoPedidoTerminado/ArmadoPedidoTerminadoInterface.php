<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoTerminado;

interface ArmadoPedidoTerminadoInterface {
  public function armadoFindOrFailById($id_armado, $relaciones);
}
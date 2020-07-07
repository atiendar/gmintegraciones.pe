<?php
namespace App\Repositories\venta\pedidoActivo\codigoQR;

interface GenerarQRInterface {
  public function pedido($id_pedido, $ruta);
}
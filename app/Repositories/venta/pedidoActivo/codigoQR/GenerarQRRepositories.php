<?php
namespace App\Repositories\venta\pedidoActivo\codigoQR;

class GenerarQRRepositories implements GenerarQRInterface {
  public function pedido($id_pedido, $ruta) {
    $codigoQR = \QrCode::format('svg')
    //  ->merge(substr(\Storage::url(\App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg_rut . \App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg), 1))
      ->size(100)
      ->margin(0)
      ->errorCorrection('H')
      ->generate(route($ruta, \Crypt::encrypt($id_pedido)));

      return $codigoQR;
  }
}
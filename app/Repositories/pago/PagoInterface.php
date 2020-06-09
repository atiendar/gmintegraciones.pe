<?php
namespace App\Repositories\pago;

interface PagoInterface {
  public function getPagoFindOrFailById($id_pago, $relaciones);
}
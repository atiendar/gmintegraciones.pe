<?php
namespace App\Repositories\factura;

interface FacturaInterface {
  public function getFacturaFindOrFailById($id_factura, $relaciones);
  
  public function getPagination($request);
}
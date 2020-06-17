<?php
namespace App\Repositories\factura;

interface FacturaInterface {
  public function getFacturaFindOrFailById($id_factura, $relaciones, $estatus);
  
  public function getPagination($request);
}
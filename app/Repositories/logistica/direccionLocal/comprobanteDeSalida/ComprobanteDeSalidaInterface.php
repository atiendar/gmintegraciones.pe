<?php
namespace App\Repositories\logistica\direccionLocal\comprobanteDeSalida;

interface ComprobanteDeSalidaInterface {
  public function comprobanteFindOrFailById($id_comprobante, $relaciones);
  
  public function store($request, $id_direccion);
}
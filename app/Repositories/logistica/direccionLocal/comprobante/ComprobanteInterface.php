<?php
namespace App\Repositories\logistica\direccionLocal\comprobante;

interface ComprobanteInterface {
  public function comprobanteFindOrFailById($id_comprobante, $relaciones);
  
  public function store($request, $id_direccion);

  public function update($request, $id_comprobante);
  
  public function storeEntrega($request, $id_comprobante);
}
<?php
namespace App\Repositories\logistica\direccionLocal;

interface DireccionLocalInterface {
  public function direccionLocalFindOrFailById($id_direccion, $relaciones);
  
  public function getPagination($request, $relaciones);

  public function storeComprobanteDeSalida($request, $id_direccion);

  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones);
}
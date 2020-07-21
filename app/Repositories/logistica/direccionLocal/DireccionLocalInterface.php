<?php
namespace App\Repositories\logistica\direccionLocal;

interface DireccionLocalInterface {
  public function direccionLocalFindOrFailById($id_direccion, $for_loc, $relaciones);
  
  public function getPagination($request, $for_loc, $relaciones);
  
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones);
}
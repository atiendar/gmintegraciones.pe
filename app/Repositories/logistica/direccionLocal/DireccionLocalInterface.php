<?php
namespace App\Repositories\logistica\direccionLocal;

interface DireccionLocalInterface {
  public function getPagination($request, $relaciones);
}
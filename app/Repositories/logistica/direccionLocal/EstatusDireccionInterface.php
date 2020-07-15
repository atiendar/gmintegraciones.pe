<?php
namespace App\Repositories\logistica\direccionLocal;

interface EstatusDireccionInterface {
  public function estatusDireccion($id_direccion);

  public function estatusArmado($direccion);
}
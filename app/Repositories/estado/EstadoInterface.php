<?php
namespace App\Repositories\estado;

interface EstadoInterface {
  public function getAllEstadosPluck($foraneo_o_local);
}
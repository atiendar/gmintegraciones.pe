<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\plantillas;

class PlantillasRepositories implements PlantillasInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $this->serviceFopen->eliminarFicheroBlade('resources\views\correo\\' . $consulta->id . '.blade.php');
  }
}
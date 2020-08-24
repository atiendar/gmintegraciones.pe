<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\productos;
// Events
use App\Events\layouts\ArchivosEliminados;

class ProductosRepositories implements ProductosInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      array($consulta->img_prod_nom), 
    );
  }
}
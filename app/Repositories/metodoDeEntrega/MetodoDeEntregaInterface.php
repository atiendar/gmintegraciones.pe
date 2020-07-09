<?php
namespace App\Repositories\metodoDeEntrega;

interface MetodoDeEntregaInterface {
  public function metodoFindOrFailById($id_metodo, $relaciones);

  public function getAllMetodosPluck();
}
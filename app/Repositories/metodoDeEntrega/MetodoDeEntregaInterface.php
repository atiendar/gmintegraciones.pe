<?php
namespace App\Repositories\metodoDeEntrega;

interface MetodoDeEntregaInterface {
  public function metodoFindOrFailById($id_metodo, $relaciones);

  public function metodoFindOrFailByNombreMetodo($nom_met_ent, $relaciones);
  
  public function getAllMetodosPluck($for_loc);
}
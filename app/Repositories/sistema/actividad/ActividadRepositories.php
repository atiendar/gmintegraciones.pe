<?php
namespace App\Repositories\sistema\actividad;
// Models
use App\Models\Actividades;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($request) {
    return Actividades::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}
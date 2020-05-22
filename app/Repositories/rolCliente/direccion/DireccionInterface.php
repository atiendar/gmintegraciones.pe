<?php
namespace App\Repositories\rolCliente\direccion;

interface DireccionInterface {
  public function store($request);

  public function storeFields($direccion, $request, $user_id);

  public function getDireccionFindOrFail($id_direccion, $relaciones);
}
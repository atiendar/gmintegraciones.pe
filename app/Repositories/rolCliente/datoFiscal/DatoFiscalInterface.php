<?php
namespace App\Repositories\rolCliente\datoFiscal;

interface DatoFiscalInterface {
  public function store($request);

  public function storeFields($dato_fiscal, $request, $user_id);

  public function getDatoFiscalFindOrFail($id_dato_fiscal, $relaciones);
}
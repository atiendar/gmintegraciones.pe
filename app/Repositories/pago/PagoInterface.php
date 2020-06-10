<?php
namespace App\Repositories\pago;

interface PagoInterface {
  public function getPagoFindOrFailById($id_pago, $relaciones, $estatus);

  public function getPagination($request);

  public function store($request, $id_pedido);

  public function update($request, $id_pago);

  public function destroy($id_pago);

  public function generateRandomString($length = 4);

  public function getMontoDePagosAprobados($pedido);

  public function modificarEstatusProduccionYAlmacen($pedido);
}
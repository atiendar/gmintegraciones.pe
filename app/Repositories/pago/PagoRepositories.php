<?php
namespace App\Repositories\pago;
// Models
use App\Models\Pago;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PagoRepositories implements PagoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function getPagoFindOrFailById($id_pago) {
    $id_pago = $this->serviceCrypt->decrypt($id_pago);
    return Pago::with('pedido')->findOrFail($id_pago);
  }
}
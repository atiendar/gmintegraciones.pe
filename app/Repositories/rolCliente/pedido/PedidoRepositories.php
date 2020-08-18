<?php
namespace App\Repositories\rolCliente\pedido;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoRepositories implements PedidoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
}
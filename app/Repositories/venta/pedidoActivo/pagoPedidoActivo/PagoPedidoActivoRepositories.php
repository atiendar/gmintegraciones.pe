<?php
namespace App\Repositories\venta\pedidoActivo\pagoPedidoActivo;
// Models
use App\Models\PedidoArmado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PagoPedidoActivoRepositories implements PagoPedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt             = $serviceCrypt;
  } 
  public function store($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      
    });
  }

}
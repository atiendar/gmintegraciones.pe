<?php
namespace App\Http\Controllers\Venta\RastrearPedido;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\rastrearPedido\RastrearPedidoRepositories;

class RastrearPedidoController extends Controller {
  protected $rastrearPedidoRepo;
  public function __construct(RastrearPedidoRepositories $rastrearPedidoRepositories) {
    $this->rastrearPedidoRepo = $rastrearPedidoRepositories;
  } 
  public function rastrear($id_pedido) {
    $this->rastrearPedidoRepo->rastrear($id_pedido);
  }
}
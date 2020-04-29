<?php
namespace App\Http\Controllers\Venta\PedidoTerminado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoTerminadoController extends Controller {
  public function index(Request $request) {
    return view('venta.pedido_terminado.ven_pedTer_index');
  }
}
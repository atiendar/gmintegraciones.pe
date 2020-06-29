<?php
namespace App\Http\Controllers\Venta\PedidoTerminado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\venta\pedidoTerminado\PedidoTerminadoRepositories;

class PedidoTerminadoController extends Controller {
  protected $pedidoTerminadoRepo;
  public function __construct(PedidoTerminadoRepositories $PedidoTerminadoRepositories) {
    $this->pedidoTerminadoRepo    = $PedidoTerminadoRepositories;    
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoTerminadoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('venta.pedido.pedido_terminado.ven_pedTer_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    dd('ss');
    $pedido                     = $this->pedidoTerminadoRepo->pedidoTerminadoFindOrFailById($id_pedido);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $armados                    = $this->pedidoTerminadoRepo->getArmadosPedidoPaginate($pedido, $request);
    return view('almacen.pedido.pedido_terminado.pedTer_show', compact('pedido', 'unificados', 'armados'));
  }
}
<?php
namespace App\Http\Controllers\Pago;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class PagoPedidoController extends Controller {
  protected $pedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories) { 
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos =  $this->pedidoActivoRepo->getPagination($request, []);
    return view('pago.fPedido.fpe_index', compact('pedidos'));
  }
  public function edit($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['pagos']);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('pago.fPedido.pago.fpe_edit', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
}
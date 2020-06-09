<?php
namespace App\Http\Controllers\Pago\fPedido;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\pago\PagoRepositories;

class PagoPedidoController extends Controller {
  protected $pedidoActivoRepo;
  protected $pagoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories, PagoRepositories $pagoRepositories) { 
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->pagoRepo         = $pagoRepositories;
  }
  public function index(Request $request) {
    $pedidos =  $this->pedidoActivoRepo->getPagination($request, []);
    return view('pago.fPedido.fpe_index', compact('pedidos'));
  }
  public function create($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['pagos']);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('pago.fPedido.fpe_create', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido']);
    return view('pago.fPedido.pago.pag_show', compact('pago'));
  }
}
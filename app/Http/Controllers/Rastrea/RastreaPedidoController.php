<?php
namespace App\Http\Controllers\Rastrea;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Models
use App\Models\Pedido;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class RastreaPedidoController extends Controller {
  protected $pedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos =  Pedido::with('usuario')->rastrear($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('rastrea.rpe_index', compact('pedidos'));
  }
  public function show($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->getPedidoFindOrFail($id_pedido, ['usuario', 'unificar', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('rastrea.pedido.rpe_show', compact('pedido', 'unificados', 'armados', 'pagos', 'mont_pag_aprov'));
  }
}
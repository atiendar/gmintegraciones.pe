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
    $this->pedidoTerminadoRepo  = $PedidoTerminadoRepositories;    
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoTerminadoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('venta.pedido.pedido_terminado.ven_pedTer_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido         = $this->pedidoTerminadoRepo->pedidoTerminadoFindOrFailById($id_pedido, ['usuario', 'unificar', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $armados        = $pedido->armados()->paginate(99999999);
    $pagos          = $pedido->pagos()->paginate(99999999);
    return view('venta.pedido.pedido_terminado.ven_pedTer_show', compact('pedido', 'unificados', 'armados', 'pagos'));
  }
  public function destroy($id_pedido) {
    $this->pedidoTerminadoRepo->destroy($id_pedido);
    toastr()->success('¡Pedido eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
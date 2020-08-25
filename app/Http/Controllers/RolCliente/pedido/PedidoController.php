<?php
namespace App\Http\Controllers\RolCliente\Pedido;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\rolCliente\pedido\PedidoClienteRepositories;

class PedidoController extends Controller {
  protected $pedidoClienteRepo;
  public function __construct(PedidoClienteRepositories $pedidoClienteRepositories) {
    $this->pedidoClienteRepo  = $pedidoClienteRepositories;
  }
  public function index(Request $request) {
    dd('index');
    $pedidos = $this->pedidoClienteRepo->getPagination($request);
    return view('rolCliente.pedido.ped_index', compact('pedidos'));
  }
  public function show($id_pago) {
    dd('show');
    $pago  = $this->pagoClienteRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido = $pago->pedido()->firstOrFail();
    return view('rolCliente.pago.pag_show', compact('pago', 'pedido'));
  }
  public function edit($id_pedido) {
    dd('edit');
    $pedido   = $this->pedidoClienteRepo->getPedidoFindOrFailById($id_pedido, ['armados'], config('app.entregado'));
    $armados  = $pedido->armados()->with('direcciones')->get();
    return view('rolCliente.pedido.ped_edit', compact('pedido', 'armados'));
  }
  public function update(Request $request, $id_pago) {
    dd('update');
    $this->pagoRepo->updateFpedido($request, $id_pago);
    toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('rolCliente.pago.index'));
  }
}
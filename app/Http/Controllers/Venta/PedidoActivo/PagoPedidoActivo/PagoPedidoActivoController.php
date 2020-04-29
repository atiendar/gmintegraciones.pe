<?php
namespace App\Http\Controllers\Venta\PedidoActivo\PagoPedidoActivo;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\pago\PagoRepositories;

class PagoPedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $pagoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories, PagoRepositories $pagoRepositories) {
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->pagoRepo         = $pagoRepositories;
  }
  public function create($id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido);
    return view('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_create', compact('pedido'));
  }
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_show', compact('pago'));
  }
}
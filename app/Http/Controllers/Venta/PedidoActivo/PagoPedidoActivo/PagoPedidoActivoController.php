<?php
namespace App\Http\Controllers\Venta\PedidoActivo\PagoPedidoActivo;
use App\Http\Controllers\Controller;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\pago\PagoRepositories;

class PagoPedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $pagoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, PagoRepositories $pagoRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->pagoRepo         = $pagoRepositories;
  }
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('venta.pedido.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_show', compact('pago'));
  }
}
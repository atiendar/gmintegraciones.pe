<?php
namespace App\Http\Controllers\Venta\PedidoActivo\PagoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoActivo\pagoPedidoActivo\StorePagoRequest;
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
  public function create($id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido);
    $pagos = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_create', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
  public function store(StorePagoRequest $request, $id_pedido) {
    $request['id_pedido'] =  $this->serviceCrypt->decrypt($id_pedido);
    $this->pagoRepo->store($request);
    toastr()->success('¡Pago registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_show', compact('pago'));
  }
}
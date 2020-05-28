<?php
namespace App\Http\Controllers\Venta\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoActivo\StorePedidoRequest;
use App\Http\Requests\venta\pedidoActivo\UpdatePedidoRequest;
use App\Http\Requests\venta\pedidoActivo\UpdateTotalDeArmadosRequest;
use App\Http\Requests\venta\pedidoActivo\UpdateMontoTotalRequest;
// Notifications
// use App\Notifications\cliente\NotificacionBienvenidaCliente;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;

class PedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $usuarioRepo;
  protected $serieRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, UsuarioRepositories $usuarioRepositories, SerieRepositories $serieRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->usuarioRepo      = $usuarioRepositories;
    $this->serieRepo        = $serieRepositories;
    $this->plantillaRepo    = $plantillaRepositories;
    $this->sistemaRepo      = $sistemaRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('venta.pedido.pedido_activo.ven_pedAct_index', compact('pedidos'));
  }
  public function show($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['usuario', 'unificar', 'armados', 'pagos']);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('venta.pedido.pedido_activo.ven_pedAct_show', compact('pedido', 'armados', 'pagos', 'mont_pag_aprov'));
  }
  public function edit($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['unificar', 'armados', 'pagos']);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('venta.pedido.pedido_activo.ven_pedAct_edit', compact('pedido', 'armados', 'pagos', 'mont_pag_aprov'));
  }
  public function update(UpdatePedidoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_pedido) {
    $this->pedidoActivoRepo->destroy($id_pedido);
    toastr()->success('¡Pedido eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
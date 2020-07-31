<?php
namespace App\Http\Controllers\Almacen\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\pedidoActivo\UpdatePedidoActivoRequest;
// Repositories
use App\Repositories\almacen\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  protected $generarQRRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen = $this->pedidoActivoRepo->getPendientes();
    return view('almacen.pedido.pedido_activo.alm_pedAct_index', compact('pedidos', 'pen'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                     = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['usuario', 'unificar']);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $armados                    = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id, [config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('almacen.pedido.pedido_activo.alm_pedAct_show', compact('pedido', 'unificados', 'armados', 'armados_terminados_almacen'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido                     = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['unificar']);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $armados                    = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id, [config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('almacen.pedido.pedido_activo.alm_pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_almacen'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);

    if($pedido->estat_alm == config('app.productos_completos_terminado')) {
      toastr()->success('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.pedidoActivo.index')); 
    }
    toastr()->success('¡Pedido modificados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('almacen.pedidoActivo.edit', $this->serviceCrypt->encrypt($pedido->id)));
  }
  public function generarOrdenDeProduccion($id_pedido){
    $pedido               = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['usuario', 'unificar']);

    $codigoQRAlmacen = $this->generarQRRepo->qr($pedido->id, 'Almacén');
    $codigoQRProduccion = $this->generarQRRepo->qr($pedido->id, 'Producción');
    $codigoQRLogistica = $this->generarQRRepo->qr($pedido->id, 'Logística');

    $armados              = $pedido->armados()->with(['productos'=> function ($query) {
                                                            $query->with('sustitutos');
                                                          }])->get();
    $orden_de_produccion  = \PDF::loadView('almacen.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados', 'codigoQRAlmacen', 'codigoQRProduccion', 'codigoQRLogistica'));
    return $orden_de_produccion->stream();
//  return $orden_de_produccion->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
  public function marcarTodoCompleto($id_pedido) {
    $pedido = $this->pedidoActivoRepo->marcarTodoCompleto($id_pedido);
    if($pedido->estat_alm == config('app.productos_completos_terminado')) {
      toastr()->success('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.pedidoActivo.index')); 
    }
    toastr()->success('¡Armados modificados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('almacen.pedidoActivo.edit', $this->serviceCrypt->encrypt($pedido->id))); 
  }
}
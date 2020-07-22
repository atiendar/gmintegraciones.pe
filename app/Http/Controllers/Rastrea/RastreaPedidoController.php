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
  public function rastrearPorQR($id, $modulo) {
    $pedido =  Pedido::findorfail($id);

    switch ($modulo) {
      case 'Almacén':
        if($pedido->estat_alm == config('app.productos_completos_terminado')) {
          return redirect(route('almacen.pedidoTerminado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('almacen.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      case 'Producción':
        if($pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
          return redirect(route('produccion.pedidoTerminado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('produccion.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      case 'Logística':
        if($pedido->estat_log == config('app.en_almacen_de_salida_terminado')) {
          return redirect(route('logistica.pedidoTerminado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('logistica.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      case 'Comprobante de salida':
        $comprobante = \App\Models\PedidoArmadoDireccionTieneComprobante::findorfail($id);

        if($comprobante->estat == config('app.entregado')) {
          return 'Ya se ha subido el comprobante con anterioridad';
        }
        return redirect(route('logistica.direccionLocal.comprobante.edit', \Crypt::encrypt($comprobante->id)));
      case 'Comprobante de entrega':
        $comprobante = \App\Models\PedidoArmadoDireccionTieneComprobante::findorfail($id);

        if($comprobante->estat == config('app.entregado')) {
          return 'Ya se ha subido el comprobante con anterioridad';
        }
        return redirect(route('logistica.direccionLocal.comprobante.createEntrega', \Crypt::encrypt($comprobante->id)));
      default:
        echo 'Opción invalida';
    }
  }
}
<?php
namespace App\Http\Controllers\Logistica\PedidoActivoLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\produccion\pedidoActivo\UpdatePedidoActivoRequest;
// Repositories
use App\Repositories\logistica\pedidoActivoLocal\PedidoActivoRepositories;
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('logistica.pedido.pedido_activoLocal.pedAct_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    dd('show');
    $pedido                        = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar']);
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $armados                       = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_show', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion'));
  }
  public function edit(Request $request, $id_pedido) {
    dd('edit');
    $pedido                         = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['unificar']);
    $unificados                     = $pedido->unificar()->paginate(99999999);
    $armados                        = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion  = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    dd('update');
    $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarOrdenDeProduccion($id_pedido) {
    dd('generarOrdenDeProduccion');
    $pedido   = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar']);
    $armados  = $pedido->armados()->with(['productos'=> function ($query) {
      $query->with('sustitutos');
    }])->get();
    $orden_de_produccion  = \PDF::loadView('produccion.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados'));
    return $orden_de_produccion->stream();
  }
}

<?php
namespace App\Http\Controllers\Almacen\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Repositories\almacen\pedidoActivo\PedidoActivoRepositories;
use App\Http\Requests\almacen\pedidoActivo\UpdatePedidoActivoRequest;
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
//Otros
use Barryvdh\DomPDF\Facade as PDF;


class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoActivoRepo = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request);
    return view('almacen.pedido.pedido_activo.alm_pedAct_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoActivoAsignadoFindOrFailById($id_pedido);
    $armados = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id);
    return view('almacen.pedido.pedido_activo.alm_pedAct_show', compact('pedido', 'armados', 'armados_terminados_almacen'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->pedidoActivoAsignadoFindOrFailById($id_pedido);
    $armados = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id);
    return view('almacen.pedido.pedido_activo.alm_pedAct_edit', compact('pedido', 'armados', 'armados_terminados_almacen'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido almacen actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function pdf($id_pedido){
    $pedido=$this->pedidoActivoRepo->pedidoActivoAsignadoFindOrFailById($id_pedido);
    $armados=$this->pedidoActivoRepo->getArmadosPedido($pedido);
    $pdf = PDF::loadView('almacen.pedido.pedido_activo.alm_pedAct_detallesPDF', compact('pedido'));
    return $pdf->stream();
  }
}
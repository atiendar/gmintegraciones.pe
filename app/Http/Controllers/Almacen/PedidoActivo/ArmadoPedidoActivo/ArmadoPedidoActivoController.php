<?php
namespace App\Http\Controllers\Almacen\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Repositories\almacen\pedidoActivo\PedidoActivoRepositories;
use App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo\UpdateArmadoPedidoActivoRequest;
// Repositories
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class ArmadoPedidoActivoController extends Controller {
    protected $pedido_almacenRepo;
    protected $armadoPedidoActivoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, PedidoActivoRepositories $PedidoActivoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->pedidoActivoRepo = $PedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    $armado = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado);
    $productos = $this->pedidoActivoRepo->getArmadoPedidoTieneProductosPaginate($armado, $request);
    return view('almacen.pedido_activo.armado_activo.alm_pedAct_armAct_show', compact('armado', 'productos'));
  }
  public function edit(Request $request, $id_armado) { 
    $armado = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado);
    $productos = $this->pedidoActivoRepo->getArmadoPedidoTieneProductosPaginate($armado, $request);
    return view('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_edit', compact('armado', 'productos'));
  }
  public function update(UpdateArmadoPedidoActivoRequest $request, $id_armado) {
    $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

}
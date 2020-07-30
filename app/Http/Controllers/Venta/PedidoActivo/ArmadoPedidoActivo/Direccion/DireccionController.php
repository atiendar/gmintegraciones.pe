<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo\Direccion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\venta\pedidoActivo\armado\direccion\UpdateDireccionRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;

class DireccionController extends Controller {
  protected $direccionArmadoRepo;
  public function __construct(DireccionArmadoRepositories $direccionArmadoRepositories) {
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
  }
  public function show($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['comprobantes', 'armado']);
    $comprobantes = $direccion->comprobantes;
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_show', compact('comprobantes', 'direccion'));
  }
  public function edit($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['armado']);
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_edit', compact('direccion'));
  }
  public function update(UpdateDireccionRequest $request, $id_direccion) {
    $this->direccionArmadoRepo->update($request, $id_direccion);
    toastr()->success('¡Dirección actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
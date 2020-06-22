<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\armado\ArmadoRepositories;

class ArmadoPedidoActivoController extends Controller {
  protected $armadoPedidoActivoRepo;
  protected $armadoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, ArmadoRepositories $armadoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->armadoRepo             = $armadoRepositories;
  }
  public function show($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['productos', 'direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $productos    = $armado->productos()->with('sustitutos')->get();
    $direcciones  = $armado->direcciones()->paginate(9);
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
  public function edit($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $direcciones  = $armado->direcciones()->paginate(9);
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_edit', compact('armado', 'pedido', 'direcciones'));
  }
}
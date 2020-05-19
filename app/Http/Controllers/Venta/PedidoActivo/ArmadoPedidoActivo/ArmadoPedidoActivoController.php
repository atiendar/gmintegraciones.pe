<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoActivo\armadoPedidoActivo\StoreArmadoRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;

class ArmadoPedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  protected $armadoRepo;
  protected $cotizacionRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, ArmadoRepositories $armadoRepositories, CotizacionRepositories $cotizacionRepositories) {
    $this->pedidoActivoRepo       = $pedidoActivoRepositories;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->armadoRepo             = $armadoRepositories;
    $this->cotizacionRepo         = $cotizacionRepositories;
  }
  public function create($id_pedido) {
    $pedido             = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido);
    $armados            = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $armados_list       = $this->armadoRepo->getAllArmadosPlunkMenos($pedido->armados);
    $cotizaciones_list  = $this->cotizacionRepo->getAllCotizacionesValidasPlunk();
    return view('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_create', compact('pedido', 'armados', 'armados_list', 'cotizaciones_list'));
  }
  public function store(StoreArmadoRequest $request, $id_pedido) {
    $this->armadoPedidoActivoRepo->store($request, $id_pedido);
    toastr()->success('¡Armado registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

  public function show($id_armado) {
    $armado = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado);
  
    $direcciones = $armado->direcciones()->paginate(9);

   

    return view('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_show', compact('armado', 'direcciones'));
  }
  public function edit($id_armado) {
    $armado = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado);
  
    $direcciones = $armado->direcciones()->paginate(9);

  

    return view('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_edit', compact('armado', 'direcciones'));
  }
}
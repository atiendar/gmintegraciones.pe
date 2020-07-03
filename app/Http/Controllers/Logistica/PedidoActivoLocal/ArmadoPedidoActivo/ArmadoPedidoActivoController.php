<?php
namespace App\Http\Controllers\Logistica\PedidoActivoLocal\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo\UpdateArmadoPedidoActivoRequest;
// Repositories
use App\Repositories\logistica\PedidoActivo\local\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ArmadoPedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $armadoPedidoActivoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    dd('show');
    $armado       = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'productos'], 'show');
    $productos    = $armado->productos()->with('sustitutos')->get();
    $direcciones  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneDireccionesPaginate($armado, $request);
    return view('produccion.pedido.pedido_activo.armado_activo.armAct_show', compact('armado', 'productos', 'direcciones'));
  }
  public function edit(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
    $pedido       = $armado->pedido()->firstOrFail();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('logistica.pedido.pedido_activo.armado_activo.armAct_edit', compact('armado', 'pedido', 'direcciones'));
  }
  public function update(UpdateArmadoPedidoActivoRequest $request, $id_armado) {
    dd('update');
    $armado = $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_revision_de_productos')) {
      if($armado->pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
        toastr()->info('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
        return redirect(route('produccion.pedidoActivo.index')); 
      }
      return redirect(route('produccion.pedidoActivo.edit', $this->serviceCrypt->encrypt($armado->pedido_id))); 
    }
    return back();
  }

}

<?php
namespace App\Http\Controllers\RolCliente\Pedido\Armado\Direccion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\rolCliente\pedido\armado\direccion\UpdateDireccionRequest;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Otros
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller {
  protected $serviceCrypt;
  protected $direccionArmadoRepo;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionArmadoRepositories $direccionArmadoRepositories, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt        = $serviceCrypt;
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
    $this->direccionRepo       = $direccionRepositories;
  }
  public function edit($id_direccion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with(['armado'])->findOrFail($id_direccion);

    // Aborta si el armado que pertene al pedido no es del cliente 
    if($direccion->armado->pedido->user_id != Auth::user()->id OR $direccion->nom_ref_uno != null) {
    abort('404');
    }

    $direcciones = $this->direccionRepo->getDireccionesClientePluck();
    return view('rolCliente.pedido.armado.direccion.dir_edit', compact('direccion', 'direcciones'));
  }
  public function update(UpdateDireccionRequest $request, $id_direccion) {
    // VALIDAR QUE SOLO PUEDA MODIFICAR SI EL NOMBRE DE LA PERSONA QUE RECIBE ES NULL
    $direccion = $this->direccionArmadoRepo->update($request, $id_direccion);
    toastr()->success('¡Dirección actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    $pedido = $direccion->armado->pedido;
    if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado')) {
      toastr()->success('¡Pedido detallado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('rolCliente.pedido.index'));
    }
    return redirect(route('rolCliente.pedido.edit', $this->serviceCrypt->encrypt($direccion->armado->pedido_id)));
  }
}
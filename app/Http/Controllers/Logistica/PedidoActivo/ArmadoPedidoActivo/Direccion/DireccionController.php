<?php
namespace App\Http\Controllers\Logistica\PedidoActivo\ArmadoPedidoActivo\Direccion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\PedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class DireccionController extends Controller {
  protected $serviceCrypt;
  protected $armadoPedidoActivoRepo;
  protected $generarQRRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
  }
  public function show($id_direccion) {
    dd('show');
  }
  public function edit(Request $request, $id_armado) {
    dd('edit');
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
    $pedido       = $armado->pedido()->firstOrFail();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('logistica.pedido.pedido_activo.armado_activo.armAct_edit', compact('armado', 'pedido', 'direcciones'));
  }
  public function generarComprobanteDeEntrega($id_direccion){
    dd('generarComprobanteDeEntrega');
    $direccion               = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_direccion, ['armado']);

    $codigoQRDireccion = $this->generarQRRepo->pedido($direccion->id, 'logistica.pedidoActivo.armado.direccion.edit');

    $comprobante_de_entrega  = \PDF::loadView('logistica.pedido.pedido_activo.export.comprobanteDeEntrega', compact('direccion', 'codigoQRDireccion'));
    return $comprobante_de_entrega->stream();
//  return $orden_de_produccion->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
  public function cargarComprobanteDeEntrega($id_direccion) {
    dd('cargarComprobanteDeEntrega');
  }
}
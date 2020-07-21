<?php
namespace App\Http\Controllers\Logistica\DireccionLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
use App\Repositories\logistica\direccionLocal\comprobanteDeSalida\ComprobanteDeSalidaRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

class DireccionLocalController extends Controller {
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  protected $comprobanteDeSalidaRepo;
  protected $generarQRRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories, ComprobanteDeSalidaRepositories $comprobanteDeSalidaRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->direccionLocalRepo       = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo      = $metodoDeEntregaRepositories;
    $this->comprobanteDeSalidaRepo  = $comprobanteDeSalidaRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
  }
  public function index(Request $request) {
    $direcciones_locales = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Local'), ['armado']);
    return view('logistica.pedido.direccion_local.dirLoc_index', compact('direcciones_locales'));
  }
  public function show($id_direccion) {
    $direccion = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), ['comprobantes']);
    $comprobantes = $direccion->comprobantes()->paginate(99999999);
    return view('logistica.pedido.direccion_local.dirLoc_show', compact('direccion', 'comprobantes'));
  }
  public function metodoDeEntregaEspecifico(Request $request, $metodo_de_entrega) {
    if( $request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailByNombreMetodo($metodo_de_entrega, ['metodosDeEntregaEspecificos']);
      return $metodo_de_entrega->metodosDeEntregaEspecificos()->pluck('nom_met_ent_esp', 'nom_met_ent_esp');
    }
  }
  public function generarComprobanteDeEntrega($id_comprobante){
    $comprobante          = $this->comprobanteDeSalidaRepo->comprobanteFindOrFailById($id_comprobante, ['direccion']);
    $direccion            = $comprobante->direccion()->with('armado')->firstOrFail();
    $armado               = $direccion->armado;
    $codigoQRDComprobante = $this->generarQRRepo->qr($comprobante->id, 'Comprobantes');

    $comprobante_de_entrega  = \PDF::loadView('logistica.pedido.pedido_activo.export.comprobanteDeEntrega', compact('comprobante', 'direccion', 'armado', 'codigoQRDComprobante'));
    return $comprobante_de_entrega->stream();
//  return $comprobante_de_entrega->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
}
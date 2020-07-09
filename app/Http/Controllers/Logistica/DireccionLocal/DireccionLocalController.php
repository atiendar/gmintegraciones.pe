<?php
namespace App\Http\Controllers\Logistica\DireccionLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class DireccionLocalController extends Controller {
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo   = $metodoDeEntregaRepositories;
  }
  public function index(Request $request) {
    $direcciones_locales = $this->direccionLocalRepo->getPagination($request, ['armado']);
    return view('logistica.pedido.direccion_local.dirLoc_index', compact('direcciones_locales'));
  }
  public function show($id_direccion) {
    $direccion = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, ['comprobantes']);
    $comprobantes = $direccion->comprobantes()->paginate(99999999);
    return view('logistica.pedido.direccion_local.dirLoc_show', compact('direccion', 'comprobantes'));
  }
  public function createComprobanteDeSalida($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, ['comprobantes']);
    $comprobantes       = $direccion->comprobantes()->paginate(99999999);
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck();
    return view('logistica.pedido.direccion_local.dirLoc_createComprobanteDeSalida', compact('direccion', 'comprobantes', 'metodos_de_entrega'));
  }
  public function storeComprobanteDeSalida(StoreComprobanteDeEntregaRequest $request, $id_direccion) {
  //  $comprobante = $this->direccionLocalRepo->storeComprobanteDeSalida($request, $id_direccion);
  //  return $comprobante;
  return [$request->hasfile('comprobante_de_salida'), $request->comprobante_de_salida];
  }












  
  public function createComprobanteDeEntrega($id_direccion) {
    $direccion = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, ['comprobantes']);
    $comprobantes = $direccion->comprobantes()->paginate(99999999);
    return view('logistica.pedido.direccion_local.dirLoc_createComprobanteDeEntrega', compact('direccion', 'comprobantes'));
  }
  public function storeComprobanteDeEntrega(Request $request, $id_direccion) {
    dd('storeComprobanteDeEntrega');

 //   estat = config('app.entregado')
   
  }
  public function metodoDeEntregaEspecifico(Request $request, $id_metodo_de_entrega) {
    if( $request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailById(\Crypt::encrypt($id_metodo_de_entrega), ['metodosDeEntregaEspecificos']);
      return $metodo_de_entrega->metodosDeEntregaEspecificos()->pluck('nom_met_ent_esp', 'nom_met_ent_esp');
    }
  }
}
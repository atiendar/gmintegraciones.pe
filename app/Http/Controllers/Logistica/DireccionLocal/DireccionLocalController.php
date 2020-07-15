<?php
namespace App\Http\Controllers\Logistica\DireccionLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class DireccionLocalController extends Controller {
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
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
  public function metodoDeEntregaEspecifico(Request $request, $metodo_de_entrega) {
    if( $request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailByNombreMetodo($metodo_de_entrega, ['metodosDeEntregaEspecificos']);
      return $metodo_de_entrega->metodosDeEntregaEspecificos()->pluck('nom_met_ent_esp', 'nom_met_ent_esp');
    }
  }
}
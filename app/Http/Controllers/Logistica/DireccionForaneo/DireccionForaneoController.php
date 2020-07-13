<?php
namespace App\Http\Controllers\Logistica\DireccionForaneo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class DireccionForaneoController extends Controller {
  protected $direccionLocalRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo   = $metodoDeEntregaRepositories;
  }
  public function index(Request $request) {
    dd('index');
    $direcciones_locales = $this->direccionLocalRepo->getPagination($request, ['armado']);
    return view('logistica.pedido.direccion_local.dirLoc_index', compact('direcciones_locales'));
  }
}
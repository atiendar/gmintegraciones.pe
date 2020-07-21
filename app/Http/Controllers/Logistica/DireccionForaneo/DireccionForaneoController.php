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
    $direcciones_foraneas = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Foráneo'), ['armado']);
    return view('logistica.pedido.direccion_foraneo.dirFor_index', compact('direcciones_foraneas'));
  }
}
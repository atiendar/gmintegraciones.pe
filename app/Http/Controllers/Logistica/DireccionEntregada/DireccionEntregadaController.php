<?php
namespace App\Http\Controllers\Logistica\DireccionEntregada;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;

class DireccionEntregadaController extends Controller {
  protected $direccionLocalRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
  }
  public function index(Request $request) {
  //  dd('index');
  $direcciones_entregadas = [];
  //  $direcciones_foraneas = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Foráneo'), []);
    return view('logistica.pedido.direccion_entregada.dirEnt_index', compact('direcciones_entregadas'));
  }
}
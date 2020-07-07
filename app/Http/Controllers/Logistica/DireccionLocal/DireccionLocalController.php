<?php
namespace App\Http\Controllers\Logistica\DireccionLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;

class DireccionLocalController extends Controller {
  protected $direccionLocalRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
  }
  public function index(Request $request) {
    $direcciones_locales = $this->direccionLocalRepo->getPagination($request, ['armado']);
    return view('logistica.pedido.direccion_local.dirLoc_index', compact('direcciones_locales'));
  }
  public function show(Request $request, $id_pedido) {
   
  }
  public function edit(Request $request, $id_pedido) {

  }
  public function update(Request $request, $id_pedido) {
    
  }
}
<?php
namespace App\Http\Controllers\Logistica\DireccionEntregada;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\direccionEntregada\DireccionEntregadaRepositories;

class DireccionEntregadaController extends Controller {
  protected $direccionEntregadaRepo;
  public function __construct(DireccionEntregadaRepositories $direccionEntregadaRepositories) {
    $this->direccionEntregadaRepo   = $direccionEntregadaRepositories;
  }
  public function index(Request $request) {
    $direcciones_entregadas = $this->direccionEntregadaRepo->getPagination($request, []);
    return view('logistica.pedido.direccion_entregada.dirEnt_index', compact('direcciones_entregadas'));
  }
  public function show($id_direccion) {
    $direccion    = $this->direccionEntregadaRepo->direccionEntregadaFindOrFailById($id_direccion, ['comprobantes', 'armado']);
    $comprobantes = $direccion->comprobantes;
    $armado       = $direccion->armado;
    return view('logistica.pedido.direccion_entregada.dirEnt_show', compact('direccion', 'comprobantes', 'armado'));
  }
}
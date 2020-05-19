<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class FacturaController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo    = $usuarioRepositories;
  }
  public function index($id_cliente) {
    $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2');
    return view('cliente.show.factura.sho_fac_index', compact('cliente'));
  }
}
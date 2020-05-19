<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class QuejaYSugerenciaController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo    = $usuarioRepositories;
  }
  public function index($id_cliente) {
    $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2');
    return view('cliente.show.quejaYSugerencia.sho_qsu_index', compact('cliente'));
  }
}
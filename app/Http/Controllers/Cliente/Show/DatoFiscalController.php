<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class DatoFiscalController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo    = $usuarioRepositories;
  }
  public function index($id_cliente) {
    $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2');
    $datos_fiscales = \App\Models\DatoFiscal::paginate(100);
    return view('cliente.show.datoFiscal.sho_dfi_index', compact('cliente', 'datos_fiscales'));
  }
}
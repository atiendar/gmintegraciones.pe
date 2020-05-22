<?php
namespace App\Http\Controllers\Pago;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\pago\PagoRepositories;

class PagoController extends Controller {
  protected $pagoRepo;
  public function __construct(PagoRepositories $pagoRepositories) { 
    $this->pagoRepo    = $pagoRepositories;
  }
  public function index(Request $request) {
    $pagos =  $this->pagoRepo->getPagination($request);
    return view('pago.individual.ind_index', compact('pagos'));
  }
  /*
  public function create() {
    $roles = $this->rolRepo->getAllRolesPluckMenos(config('app.rol_cliente'));
    $plantillas = $this->plantillaRepo->getAllPlantillasModuloPluck('Usuarios (Bienvenida)');
    $plantilla_default = $this->sistemaRepo->datos('plant_usu_bien');
    return view('usuario.usu_create', compact('roles', 'plantillas', 'plantilla_default'));
  }
  public function store(StoreUsuarioRequest $request) {
    $this->usuarioRepo->store($request);
    toastr()->success('¡Usuario registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  */
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('pago.individual.ind_show', compact('pago'));
  }
  public function edit($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('pago.individual.ind_edit', compact('pago'));
  }
  /*
  public function update(UpdateUsuarioRequest $request, $id_pago) {
    $usuario = $this->pagoRepo->update($request, $id_pago);
    toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  */
  public function destroy($id_pago) {
    $this->pagoRepo->destroy($id_pago);
    toastr()->success('¡Pago eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
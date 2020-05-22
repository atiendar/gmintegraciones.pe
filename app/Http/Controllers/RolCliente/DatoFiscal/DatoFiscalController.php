<?php
namespace App\Http\Controllers\RolCliente\DatoFiscal;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\rolCliente\datoFiscal\StoreDatoFiscalRequest;
// Repositories
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;

class DatoFiscalController extends Controller {
  protected $datoFiscalRepo;
  public function __construct(DatoFiscalRepositories $datoFiscalRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->datoFiscalRepo    = $datoFiscalRepositories;
  }
  public function store(StoreDatoFiscalRequest $request) {
    $this->datoFiscalRepo->store($request);
    toastr()->success('¡Dato fiscal registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
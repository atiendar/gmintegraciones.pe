<?php
namespace App\Http\Controllers\RolCliente\DatoFiscal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\datoFiscal\StoreDatoFiscalRequest;
// Repositories
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class DatoFiscalController extends Controller {
  protected $serviceCrypt;
  protected $datoFiscalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DatoFiscalRepositories $datoFiscalRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->serviceCrypt   = $serviceCrypt;
    $this->datoFiscalRepo = $datoFiscalRepositories;
  }
  public function store(StoreDatoFiscalRequest $request) {
    $this->datoFiscalRepo->store($request);
    toastr()->success('¡Dato fiscal registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function getInformacionDatoFiscal(Request $request, $id_dato_fiscal) {
    if($request->ajax()) {
      $dato_fiscal = $this->datoFiscalRepo->getDatoFiscalFindOrFail($this->serviceCrypt->encrypt($id_dato_fiscal), []);
      return response()->json($dato_fiscal);
    }
  }
}
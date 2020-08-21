<?php
namespace App\Http\Controllers\RolCliente\Pago;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\rolCliente\pago\PagoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PagoController extends Controller {
  protected $serviceCrypt;
  protected $pagoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PagoRepositories $pagoRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->pagoRepo       = $pagoRepositories;
  }
  public function index(Request $request) {
    $pagos = $this->pagoRepo->getPagination($request);
    return view('rolCliente.pago.pag_index', compact('pagos'));
  }
  public function create() {
    return view('rolCliente.pago.pag_create');
  }
  public function store(Request $request) {   
    $this->pagoRepo->store($request);
    toastr()->success('¡Pago registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pago) {
    dd('show');
    $pago  = $this->pagoRepo->getPagoFindOrFail($id_pago, []);
    return view('rolCliente.pagos.fac_show', compact('pago'));
  }
}
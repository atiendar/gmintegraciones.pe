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
    dd('create');
    $datos_fiscales         = $this->datoFiscalRepo->getAllDatosFiscalesClientePluck();
    $codigos_de_facturacion = $this->pagoRepo->getAllCodigosFacturaClientePluck();
    return view('rolCliente.factura.fac_create', compact('datos_fiscales', 'codigos_de_facturacion'));
  }
  public function store(Request $request) {
    dd('store');
    $this->facturaRepo->store($request);
    toastr()->success('¡Factura solicitada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pago) {
    dd('show');
    $pago  = $this->pagoRepo->getPagoFindOrFail($id_pago, []);
    return view('rolCliente.pagos.fac_show', compact('pago'));
  }
}
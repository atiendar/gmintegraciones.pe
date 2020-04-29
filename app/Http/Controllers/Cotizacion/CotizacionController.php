<?php
namespace App\Http\Controllers\Cotizacion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\cotizacion\StoreCotizacionRequest;
//Repositories
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\armado\ArmadoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class CotizacionController extends Controller {
  protected $cotizacionRepo;
  protected $serieRepo;
  protected $serviceCrypt;
  protected $usuarioRepo;
  protected $armadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, SerieRepositories $serieRepositories, CotizacionRepositories $cotizacionRepositories, UsuarioRepositories $usuarioRepositories, ArmadoRepositories $armadoRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->serieRepo      = $serieRepositories;
    $this->cotizacionRepo = $cotizacionRepositories;
    $this->usuarioRepo    = $usuarioRepositories;
    $this->armadoRepo     = $armadoRepositories;
  }
  public function index(Request $request) {
    $cotizaciones = $this->cotizacionRepo->getPagination($request);
    return view('cotizacion.cot_index', compact('cotizaciones'));
  }
  public function create() {
    $series_list = $this->serieRepo->getAllInputSeriesPlunk('Cotizaciones (Serie)');
    $clientes_list = $this->usuarioRepo->getAllClientesPlunk();
    return view('cotizacion.cot_create',compact('series_list', 'clientes_list'));
  }
  public function store(StoreCotizacionRequest $request) {
    $cotizacion = $this->cotizacionRepo->store($request);
    if(auth()->user()->can('cotizacion.edit')) {
      toastr()->success('¡Cotización registrada exitosamente ahora puedes registrar sus productos!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('cotizacion.edit', $this->serviceCrypt->encrypt($cotizacion->id))); 
    }
    toastr()->success('¡Cotización registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_cotizacion) {
    $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion);
    return view('cotizacion.cot_show', compact('cotizacion'));
  }
  public function edit($id_cotizacion) {
    $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion);
    $clientes_list = $this->usuarioRepo->getAllClientesPlunk();
    $clientes_list[$cotizacion->email_cliente] = $cotizacion->email_cliente;
    $armados = $cotizacion->armados()->with('productos')->paginate(99999999);
    $armados_list = $this->armadoRepo->getAllArmadosPlunkMenos($cotizacion->armados);
    return view('cotizacion.cot_edit', compact('cotizacion', 'clientes_list', 'armados', 'armados_list'));
  }
  public function update(Request $request, $id_cotizacion) {
    dd('update');
  }
  public function destroy($id_cotizacion) {
    dd('destroy');
  }
}
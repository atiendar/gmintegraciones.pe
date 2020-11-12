<?php
namespace App\Http\Controllers\RolFerro\Envio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolFerro\envio\local\UpdateEnvioLocalRequest;
// Repositories
use App\Repositories\rolFerro\envio\local\EnvioForaneoRepositories;
use App\Repositories\rolFerro\ruta\RutaRepositories;

class EnvioForaneoController extends Controller {
  protected $envioForaneoRepo;
  protected $rutaRepo;
  public function __construct(EnvioForaneoRepositories $envioForaneoRepositories, RutaRepositories $rutaRepositories) {
    $this->envioForaneoRepo = $envioForaneoRepositories;
    $this->rutaRepo         = $rutaRepositories;
  }
  public function index(Request $request) {
    $envios = $this->envioForaneoRepo->getPagination($request, 'Foráneo', []);
    return view('rolFerro.envio.local.eloc_index', compact('envios'));
  }
  public function show($id_envio) {
    $envio = $this->envioForaneoRepo->envioFindOrFailById($id_envio, 'Foráneo', []);
    return view('rolFerro.envio.local.eloc_show', compact('envio'));
  }
  public function edit($id_envio) {
    $envio = $this->envioForaneoRepo->envioFindOrFailById($id_envio, 'Foráneo', []);
    $rutas = $this->rutaRepo->allRutasPlunk();
    return view('rolFerro.envio.local.eloc_edit', compact('envio', 'rutas'));
  }
  public function update(UpdateEnvioLocalRequest $request, $id_envio) {
    $this->envioForaneoRepo->update($request, $id_envio);
    toastr()->success('¡Envio actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporteDeForaneos() {
    return (new \App\Exports\rolFerro\envio\generarReporteDeEnviosForaneosExport)->download('ReporteDeEnviosForaneos-'.date('Y-m-d').'.xlsx');
  }
}
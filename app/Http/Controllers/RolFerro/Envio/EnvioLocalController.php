<?php
namespace App\Http\Controllers\RolFerro\Envio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\RolFerro\envio\local\UpdateEnvioLocalRequest;
// Repositories
use App\Repositories\rolFerro\envio\local\EnvioLocalRepositories;

class EnvioLocalController extends Controller {
  protected $envioLocalRepo;
  public function __construct(EnvioLocalRepositories $envioLocalRepositories) {
    $this->envioLocalRepo = $envioLocalRepositories;
  }
  public function index(Request $request) {
    $envios = $this->envioLocalRepo->getPagination($request, 'Foráneo', []);
    return view('rolFerro.envio.local.eloc_index', compact('envios'));
  }
  public function show($id_envio) {
    $envio = $this->envioLocalRepo->envioFindOrFailById($id_envio, []);
    return view('rolFerro.envio.local.eloc_show', compact('envio'));
  }
  public function edit($id_envio) {
    $ruta = $this->envioLocalRepo->envioFindOrFailById($id_envio, []);
    return view('rolFerro.envio.local.eloc_edit', compact('envio',));
  }
  public function update(UpdateEnvioLocalRequest $request, $id_ruta) {
    $this->envioLocalRepo->update($request, $id_ruta);
    toastr()->success('¡Envio actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

}
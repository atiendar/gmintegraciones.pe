<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\sistema\sistema\UpdateSistemaRequest;
// Repositories
use App\Repositories\sistema\sistema\SistemaRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;

class SistemaController extends Controller {
  protected $sistemaRepo;
  protected $plantillaRepo;
  public function __construct(SistemaRepositories $sistemaRepositories, PlantillaRepositories $plantillaRepositories) { // Interfaz para implementar solo [metodos]
    $this->sistemaRepo = $sistemaRepositories;
    $this->plantillaRepo = $plantillaRepositories;
  }
  public function edit() {
    $plantillas_usu =  $this->plantillaRepo->getAllPlantillasModuloPluck('Usuarios');
    $plantillas_cli = $this->plantillaRepo->getAllPlantillasModuloPluck('Clientes');
    $plantillas_per_camb_pass = $this->plantillaRepo->getAllPlantillasModuloPluck('Perfil');
    $plantillas_sis_rest_pass =$this->plantillaRepo->getAllPlantillasModuloPluck('Sistema');
    $plantillas_cotizaciones =$this->plantillaRepo->getAllPlantillasModuloPluck('Cotizaciones');
    $plantillas_ventas =$this->plantillaRepo->getAllPlantillasModuloPluck('Ventas');
    return view('sistema.sistema.sis_sis_index', compact('plantillas_usu', 'plantillas_cli', 'plantillas_per_camb_pass', 'plantillas_sis_rest_pass', 'plantillas_cotizaciones', 'plantillas_ventas'));
  }
  public function update(UpdateSistemaRequest $request) {
    $this->sistemaRepo->update($request);
    toastr()->success('¡Información del sistema actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
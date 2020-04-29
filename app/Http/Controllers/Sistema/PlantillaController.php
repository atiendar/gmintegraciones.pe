<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\plantilla\StorePlantillaRequest;
use App\Http\Requests\sistema\plantilla\UpdatePlantillaRequest;
// Repositories
use App\Repositories\sistema\plantilla\PlantillaRepositories;

class PlantillaController extends Controller {
  protected $plantillaRepo;
  public function __construct(PlantillaRepositories $plantillaRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->plantillaRepo = $plantillaRepositories;
  }
  public function index(Request $request) {
    $plantillas = $this->plantillaRepo->getPagination($request);
    return view('sistema.plantilla.sis_pla_index', compact('plantillas'));
  }
  public function create() {
  	return view('sistema.plantilla.sis_pla_create');
  }
  public function store(StorePlantillaRequest $request) {
    $this->plantillaRepo->store($request);
    toastr()->success('¡Plantilla registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	  return back();
  }
  public function show($id_plantilla) {
    $plantilla = $this->plantillaRepo->plantillaAsignadoFindOrFailById($id_plantilla);
    return view('sistema.plantilla.sis_pla_show', compact('plantilla'));
  }
  public function edit($id_plantilla) {
    $plantilla = $this->plantillaRepo->plantillaAsignadoFindOrFailById($id_plantilla);
    return view('sistema.plantilla.sis_pla_edit', compact('plantilla'));
  }
  public function update(UpdatePlantillaRequest $request, $id_plantilla) {
    $this->plantillaRepo->update($request, $id_plantilla);
    toastr()->success('¡Plantilla actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_plantilla) {
    $this->plantillaRepo->destroy($id_plantilla);
    toastr()->success('¡Plantilla eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
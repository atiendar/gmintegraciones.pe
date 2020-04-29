<?php
namespace App\Http\Controllers\Cotizacion\ArmadoCotizacion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\cotizacion\armadoCotizacion\StoreArmadoCotizacionRequest;
use App\Http\Requests\cotizacion\armadoCotizacion\UpdateCantidadRequest;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;

class ArmadoCotizacionController extends Controller {
  protected $armadoCotizacionRepo;
  public function __construct(ArmadoCotizacionRepositories $armadoCotizacionRepositories) {
    $this->armadoCotizacionRepo  = $armadoCotizacionRepositories;
  }
  public function store(StoreArmadoCotizacionRequest $request, $id_cotizacion) {
    $this->armadoCotizacionRepo->store($request, $id_cotizacion);
    toastr()->success('¡Armado registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_cotizacion) {
    $this->armadoCotizacionRepo->destroy($id_cotizacion);
    toastr()->success('¡Armado eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
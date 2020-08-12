<?php
namespace App\Http\Controllers\CostoDeEnvio;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoRepositories;

class OpcionesCostosController extends Controller {
  protected $armadoCotizacionRepo;
  protected $direccionArmadoRepo;
  public function __construct(ArmadoCotizacionRepositories $armadoCotizacionRepositories, DireccionArmadoRepositories $direccionArmadoRepositories) {
    $this->armadoCotizacionRepo = $armadoCotizacionRepositories;
    $this->direccionArmadoRepo  = $direccionArmadoRepositories;
  }
  public function getOpcionesCostos($id_armado) {
    $armado       = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, ['direcciones', 'cotizacion']);
    $cotizacion   = $armado->cotizacion;
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('costo_de_envio.opcionesCostos.cos_index', compact('cotizacion', 'armado', 'direcciones'));
  }
  public function getOpcionesDirecciones($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion);
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($direccion->armado->cotizacion->estat);
    $armado = $direccion->armado;
    return view('costo_de_envio.opcionesCostos.direccion.dir_index', compact('armado', 'direccion'));
  }
}
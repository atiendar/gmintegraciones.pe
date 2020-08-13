<?php
namespace App\Http\Controllers\CostoDeEnvio;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoRepositories;
use App\Repositories\costoDeEnvio\CostoDeEnvioRepositories;

class OpcionesCostosController extends Controller {
  protected $armadoCotizacionRepo;
  protected $direccionArmadoRepo;
  protected $costoDeEnvioRepo;
  public function __construct(ArmadoCotizacionRepositories $armadoCotizacionRepositories, DireccionArmadoRepositories $direccionArmadoRepositories, CostoDeEnvioRepositories $costoDeEnvioRepositories) {
    $this->armadoCotizacionRepo = $armadoCotizacionRepositories;
    $this->direccionArmadoRepo  = $direccionArmadoRepositories;
    $this->costoDeEnvioRepo     = $costoDeEnvioRepositories;
  }
  public function getOpcionesCostos($id_armado) {
    $armado       = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, ['direcciones', 'cotizacion']);
    $cotizacion   = $armado->cotizacion;
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($cotizacion->estat);
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('costo_de_envio.opcionesCostos.cos_index', compact('cotizacion', 'armado', 'direcciones'));
  }
  public function getOpcionesDirecciones($id_direccion) {
    $costo_de_envio = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion);
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($costo_de_envio->armado->cotizacion->estat);
    $armado = $costo_de_envio->armado;
    $requ = (Object) [
      'metodo_de_entrega' => null,
      'estado'            => $costo_de_envio->est,
      'tipo_de_envio'     => null,
      'tamano'            => $costo_de_envio->tam
    ];
    $costos_de_envio = $this->costoDeEnvioRepo->obtener($requ);
    return view('costo_de_envio.opcionesCostos.direccion.dir_index', compact('armado', 'costo_de_envio', 'costos_de_envio'));
  }
}
<?php
namespace App\Repositories\cotizacion\armadoCotizacion\direccionArmado;
// Models
use App\Models\CotizacionArmadoTieneDirecciones;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionArmadoRepositories implements DireccionArmadoInterface {
  protected $serviceCrypt;
  protected $cotizacionRepo;
  protected $calcularValoresCotizacionRepo;
  protected $armadoCotizacionRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, CotizacionRepositories $cotizacionRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, ArmadoCotizacionRepositories $armadoCotizacionRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->cotizacionRepo                       = $cotizacionRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->armadoCotizacionRepo                 = $armadoCotizacionRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function direccionFindOrFailById($id_direccion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = CotizacionArmadoTieneDirecciones::with('armado')->findOrFail($id_direccion);
    return $direccion;
  }
  public function store($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado     = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, 'cotizacion');
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;

      // GUARDA LA DIRECCIÓN AL ARMADO
      $direccion = new CotizacionArmadoTieneDirecciones();
      $direccion->cant                      = $request->cantidad;
      $direccion->met_de_entreg_de_vent     = $request->metodo_de_entrega;
      $direccion->est_a_la_q_se_cotiz       = $request->estado_al_que_se_cotizo;
      $direccion->detalles_de_la_ubicacion  = $request->detalles_de_la_ubicacion;
      $direccion->tip_env                   = $request->tipo_de_envio;
      $direccion->cost_por_env_vent         = $request->costo_de_envio;
      $direccion->armado_id                 = $armado->id;
      $direccion->created_at_dir            = Auth::user()->email_registro;
      $direccion->save();
      
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado->cost_env         += $direccion->cost_por_env_vent;
      $armado->cant_direc_carg  += $direccion->cant;
      $armado = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      $cotizacion->save();
      return $direccion;
    });
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion  = $this->direccionFindOrFailById($id_direccion);
      $armado     = $direccion->armado()->with('cotizacion')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);

      // ACTUALIZA LOS DATOS DE LA DIRECCIÓN
      $cant_direc_orig                      = $direccion->cant;
      $cost_por_env_vent_orig               = $direccion->cost_por_env_vent;
      $direccion->cant                      = $request->cantidad;
      $direccion->met_de_entreg_de_vent     = $request->metodo_de_entrega;
      $direccion->est_a_la_q_se_cotiz       = $request->estado_al_que_se_cotizo;
      $direccion->detalles_de_la_ubicacion  = $request->detalles_de_la_ubicacion;
      $direccion->tip_env                   = $request->tipo_de_envio;
      $direccion->cost_por_env_vent         = $request->costo_de_envio;
      if($direccion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Usuarios', // Módulo
          'usuario.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Cantidad', 'Método de entrega', 'Estado al que se cotizo', 'Detalles de la ubicación', 'Tipo de envío', 'Costo de envío'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('cant', 'met_de_entreg_de_vent', 'est_a_la_q_se_cotiz', 'detalles_de_la_ubicacion', 'tip_env', 'cost_por_env_vent') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_dir  = Auth::user()->email_registro;
      }
      $direccion->save();

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->cost_env        -= $cost_por_env_vent_orig;
      $armado->cost_env        += $direccion->cost_por_env_vent;
      $armado->cant_direc_carg -= $cant_direc_orig;
      $armado->cant_direc_carg += $direccion->cant;
      $armado                   = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($armado->cotizacion);

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_direccion) {
    try { DB::beginTransaction();
      $direccion  = $this->direccionFindOrFailById($id_direccion);
      $armado     = $direccion->armado()->with('cotizacion')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $direccion->delete();

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->cost_env        -= $direccion->cost_por_env_vent;
      $armado->cant_direc_carg -= $direccion->cant;
      $armado                   = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($armado->cotizacion);

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
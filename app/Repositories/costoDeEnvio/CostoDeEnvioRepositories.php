<?php
namespace App\Repositories\costoDeEnvio;
// Models
use App\Models\CostoDeEnvio;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class CostoDeEnvioRepositories implements CostoDeEnvioInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  } 
  public function costoDeEnvioAsignadoFindOrFailById($id_costo) {
    $id_costo = $this->serviceCrypt->decrypt($id_costo);
    $costo_de_envio = CostoDeEnvio::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_costo);
    return $costo_de_envio;
  }
  public function getPagination($request) {
    return CostoDeEnvio::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $costo_de_envio = new CostoDeEnvio();
      $costo_de_envio->for_loc        = $request->foraneo_o_local;
      $costo_de_envio->met_de_entreg  = $request->metodo_de_entrega;
      $costo_de_envio->est            = $request->estado;
      $costo_de_envio->tip_env        = $request->tipo_de_envio;
      $costo_de_envio->tip_emp        = $request->tipo_de_empaque;
      $costo_de_envio->seg            = $request->cuenta_con_seguro;
      $costo_de_envio->tiemp_ent      = $request->tiempo_de_entrega;
      $costo_de_envio->cost_por_env   = $request->costo_por_envio;
      $costo_de_envio->asignado_env   = Auth::user()->email_registro;
      $costo_de_envio->created_at_env = Auth::user()->email_registro;
      $costo_de_envio->save();
      
      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_costo) {
    try { DB::beginTransaction();
      $costo_de_envio                 = $this->costoDeEnvioAsignadoFindOrFailById($id_costo);
      $costo_de_envio->tip_emp        = $request->tipo_de_empaque;
      $costo_de_envio->seg            = $request->cuenta_con_seguro;
      $costo_de_envio->tiemp_ent      = $request->tiempo_de_entrega;
      $costo_de_envio->est            = $request->estado;
      $costo_de_envio->met_de_entreg  = $request->metodo_de_entrega;
      $costo_de_envio->for_loc        = $request->foraneo_o_local;
      $costo_de_envio->tip_env        = $request->tipo_de_envio;
      $costo_de_envio->cost_por_env   = $request->costo_por_envio;

      if($costo_de_envio->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Costos de envío', // Módulo
          'costoDeEnvio.show', // Nombre de la ruta
          $id_costo, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_costo), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Tipo de empaque', 'Cuenta con seguro', 'Tiempo de entrega','Estado', 'Método de entrega', 'Foráneo o local', 'Tipo de envío', 'Costo por envío'), // Nombre de los inputs del formulario
          $costo_de_envio, // Request
          array('tip_emp', 'seg', 'tiemp_ent','est', 'met_de_entreg', 'for_loc', 'tip_env', 'cost_por_env') // Nombre de los campos en la BD
        ); 
        $costo_de_envio->updated_at_env  = Auth::user()->email_registro;
      }
      $costo_de_envio->save();

      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_costo) {
    try { DB::beginTransaction();
      $costo_de_envio = $this->costoDeEnvioAsignadoFindOrFailById($id_costo);
      $costo_de_envio->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Costos de envío', // Nombre del módulo del sistema
        'registro'    => $costo_de_envio->est, // Información a mostrar en la papelera
        'tab'         => 'costos_de_envio', // Nombre de la tabla en la BD
        'id_reg'      => $costo_de_envio->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function obtener($request) {
    $datos = CostoDeEnvio::metodoDeEntrega($request->metodo_de_entrega)->estado($request->estado)->tipoDeEnvio($request->tipo_de_envio)->sinSeleccion($request->metodo_de_entrega, $request->estado, $request->tipo_de_envio)->orderBy('cost_por_env', 'ASC')->get();
    return $datos;
  }
}
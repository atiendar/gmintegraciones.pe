<?php
namespace App\Repositories\rolFerro\envio\local;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class EnvioLocalRepositories implements EnvioLocalInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function envioFindOrFailById($id_ruta, $relaciones) {
		dd('');
    $id_ruta = $this->serviceCrypt->decrypt($id_ruta);
    return PedidoArmadoTieneDireccion::with($relaciones)->findOrFail($id_ruta);
  }
  public function getPagination($request, $for_loc, $relaciones) {
		return PedidoArmadoTieneDireccion::with($relaciones)
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg');
      }]);
    }])
    ->where('for_loc', $for_loc)
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
			})
			->where('met_de_entreg', 'Transportes Ferro')			
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_en_alm_salida', 'DESC')
		->paginate($request->paginador);
  }
  public function update($request, $id_ruta) {
		dd('');
    try { DB::beginTransaction();
      $ruta       = $this->envioFindOrFailById($id_ruta, []);
      $ruta->nom  = $request->nombre_de_la_ruta;
     
      if($ruta->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Rutas (Rol Ferro)', // Módulo
          'rolFerro.ruta.show', // Nombre de la ruta
          $id_ruta, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_ruta), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre de la ruta'), // Nombre de los inputs del formulario
          $ruta, // Request
          array('nom') // Nombre de los campos en la BD
        ); 
        $ruta->updated_at_reg  = Auth::user()->email_registro;
      }
    
      $ruta->save();

      DB::commit();
      return $ruta;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
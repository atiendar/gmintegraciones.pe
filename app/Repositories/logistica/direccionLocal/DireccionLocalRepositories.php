<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function direccionLocalFindOrFailById($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->where('for_loc', config('opcionesSelect.select_foraneo_local.Local'))->where(function ($query) {
      $query->where('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })->findOrFail($id_direccion);
    return $direccion;
  }
  public function getPagination($request, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->where('for_loc', config('opcionesSelect.select_foraneo_local.Local'))
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('id', 'DESC')
    ->paginate($request->paginador);
  }
  public function storeComprobanteDeSalida($request, $id_direccion) {
    try { DB::beginTransaction();
      $comprobante                            = new PedidoArmadoDireccionTieneComprobante();
      $comprobante->cant                      = $request->cantidad;
      $comprobante->met_de_entreg_de_log      = $request->metodo_de_entrega;
      $comprobante->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_espesifico;
      $comprobante->direccion_id              = $id_direccion;
      
    //  estat = config('app.en_ruta')

      if($request->hasfile('comprobante_de_salida')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('comprobante_de_salida'), // Archivo blob
          'public/venta/comprobantes_de_salida/'.date("Y").'/'.$comprobante->cant.'/', // Ruta en la que guardara el archivo
          'comprobante_de_salida-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $comprobante->comp_de_sal_rut  = $imagen[0]['ruta'];
        $comprobante->comp_de_sal_nom  = $imagen[0]['nombre'];
      }

      $comprobante->save();

      DB::commit();
      return $comprobante;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones) {
    $up_estaus     = NULL;
    $ids                    = NULL;
    $nom_tabla = (new PedidoArmadoTieneDireccion())->getTable();

    foreach($direcciones as $direccion) {
      $up_estaus  .= ' WHEN '. $direccion->id. ' THEN "'. config('app.en_almacen_de_salida').'"';
      $ids        .= $direccion->id.',';
    }

    
    if($up_estaus != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estaus." END WHERE id IN (".$ids.")");
    }
  }
}
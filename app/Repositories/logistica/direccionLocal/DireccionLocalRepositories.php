<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt         = $serviceCrypt;
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
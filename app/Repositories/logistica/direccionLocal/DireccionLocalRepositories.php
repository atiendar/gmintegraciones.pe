<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
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
  public function getPagination($request, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}
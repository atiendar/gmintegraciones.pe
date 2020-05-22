<?php
namespace App\Repositories\almacen\pedidoTerminado;
// Models
use App\Models\Pedido;
// Events

// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getPagination($request) {
    return Pedido::with('usuario')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)
    ->where('estat_alm', config('app.productos_completos_terminado'))
    ->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}

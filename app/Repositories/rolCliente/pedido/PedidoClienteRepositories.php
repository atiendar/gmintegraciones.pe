<?php
namespace App\Repositories\rolCliente\pedido;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoClienteRepositories implements PedidoClienteInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getPedidoFindOrFailById($id_pedido, $relaciones, $estatus) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    return Pedido::with($relaciones)->where('user_id', Auth::user()->id)->estatus($estatus)->findOrFail($id_pedido);
  }
  public function getPagination($request) {
    return Pedido::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function getPedidosSinPagarClientePluck() {
    return Pedido::where('user_id', Auth::user()->id)->where('estat_pag', '!=', config('app.pagado'))->orderBy('num_pedido', 'ASC')->pluck('num_pedido', 'id');
  }
  public function getArmadosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
}
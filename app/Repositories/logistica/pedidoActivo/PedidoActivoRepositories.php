<?php
namespace App\Repositories\logistica\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getPagination($request, $relaciones) {
    return Pedido::with($relaciones)->where(function ($query) {
      $query->where('estat_log', config('app.en_espera_de_produccion'))
      ->orWhere('estat_log', config('app.en_almacen_de_salida'))
      ->orWhere('estat_log', config('app.en_ruta'))
      ->orWhere('estat_log', config('app.sin_entrega_por_falta_de_informacion'))
      ->orWhere('estat_log', config('app.intento_de_entrega_fallido'));
    })->buscar($request->opcion_buscador, $request->buscador)->orderBy('fech_estat_log', 'DESC')->paginate($request->paginador);
  }
  public function pedidoActivoLogisticaFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where(function ($query) {
      $query->where('estat_log', config('app.en_espera_de_produccion'))
        ->orWhere('estat_log', config('app.en_almacen_de_salida'))
        ->orWhere('estat_log', config('app.en_ruta'))
        ->orWhere('estat_log', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat_log', config('app.intento_de_entrega_fallido'));
      })->findOrFail($id_pedido);
    return $pedido;
  }
  public function update($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $pedido                    = $this->pedidoActivoLogisticaFindOrFailById($id_pedido, []);
      $pedido->coment_log     = $request->comentario_logistica;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Logística (Pedidos activos)', // Módulo
          'logistica.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comentario logística'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('coment_log') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');
      return $pedido;
    });
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
}
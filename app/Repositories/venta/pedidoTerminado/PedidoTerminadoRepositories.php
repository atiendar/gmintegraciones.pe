<?php
namespace App\Repositories\venta\pedidoTerminado;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use DB;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  }
  public function pedidoTerminadoFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)
    ->where('estat_log', config('app.entregado'))
    ->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) {
    return Pedido::with($relaciones)
    ->where('estat_log', config('app.entregado'))
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_log', 'DESC')->paginate($request->paginador);
  }
  public function destroy($id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoTerminadoFindOrFailById($id_pedido, []);
      $pedido->delete();
      // EN AUTOMATICO ELIMINA LA UNIFICACION QUE TIENE CON LOS DEMAS PEDIDOS

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Ventas pedido terminado', // Nombre del módulo del sistema
        'registro'    => $pedido->num_pedido, // Información a mostrar en la papelera
        'tab'         => 'pedidos', // Nombre de la tabla en la BD
        'id_reg'      => $pedido->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}

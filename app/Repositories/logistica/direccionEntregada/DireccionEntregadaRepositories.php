<?php
namespace App\Repositories\logistica\direccionEntregada;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class DireccionEntregadaRepositories implements DireccionEntregadaInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt                   = $serviceCrypt;
  }
  public function direccionEntregadaFindOrFailById($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)
    ->whereBetween('updated_at', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->where('estat', config('app.entregado'))
    ->findOrFail($id_direccion);
    return $direccion;
  }
  public function getPagination($request, $relaciones) {
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->whereBetween('updated_at', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg');
      }]);
    }])
    ->where('estat', config('app.entregado'))
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('updated_at', 'DESC')
    ->paginate($request->paginador);
  }
}
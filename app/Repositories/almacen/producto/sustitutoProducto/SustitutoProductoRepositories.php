<?php
namespace App\Repositories\almacen\producto\sustitutoProducto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use DB;

class SustitutoProductoRepositories implements SustitutoProductoInterface {
  protected $serviceCrypt;
  protected $proveedorRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->productoRepo = $productoRepositories;
  }
  public function store($request, $id_producto) {
    DB::transaction(function() use($request, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto);
      $producto->sustitutos()->attach($request->ids_sustituto);
      return $producto;
    });
  }
  public function destroy($id_producto, $id_sustituto) {
    DB::transaction(function() use($id_producto, $id_sustituto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto);
      $producto->sustitutos()->detach($this->serviceCrypt->decrypt($id_sustituto));
      return $producto;
    });
  }
}
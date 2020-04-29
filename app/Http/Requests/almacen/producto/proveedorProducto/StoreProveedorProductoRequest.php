<?php
namespace App\Http\Requests\almacen\producto\proveedorProducto;
use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_del_proveedor'    => 'required|exists:proveedores,id',
      'precio_proveedor'        => 'required|min:0|numeric|alpha_decimal15',
      'utilidad'                => 'required|in:.1,.2,.3,.4,.5,.6,.7,.8,.9',
      'precio_cliente'          => 'required|min:0|numeric|alpha_decimal18',
    ];
  }
}
<?php
namespace App\Http\Requests\almacen\producto\proveedorProducto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'precio_proveedor'        => 'required|numeric|alpha_decimal15',
      'utilidad'                => 'required|in:.1,.2,.3,.4,.5,.6,.7,.8,.9',
      'precio_cliente'          => 'required|numeric|alpha_decimal18',
    ];
  }
}
<?php
namespace App\Http\Requests\almacen\producto;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'imagen_del_producto'       => 'nullable|max:1024|image',
      'nombre_del_producto'       => 'required|max:70|unique:productos,produc',
      'sku'                       => 'required|max:30|unique:productos,sku',
      'marca'                     => 'required|max:70',
      'tipo'                      => 'required|in:Producto,Canasta',
      'alto'                      => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'ancho'                     => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'largo'                     => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'costo_de_armado'           => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal15',
      'categoria'                 => 'required|max:150|exists:catalogos,value',
      'etiqueta'                  => 'required|max:150|exists:catalogos,value',
      'peso'                      => 'required|min:0|numeric|alpha_decimal7',
      'codigo_de_barras'          => 'required|max:250',
      'descripcion_del_producto'  => 'nullable|max:30000|string',
    ];
  }
}
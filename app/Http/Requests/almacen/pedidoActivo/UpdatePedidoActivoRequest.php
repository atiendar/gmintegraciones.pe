<?php
namespace App\Http\Requests\almacen\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'lider_de_pedido_almacen' => 'required|max:80',
      'comentario_almacen'      => 'nullable|max:65500|string',
    ];
  }
}
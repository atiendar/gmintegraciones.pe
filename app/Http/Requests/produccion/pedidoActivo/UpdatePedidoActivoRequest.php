<?php
namespace App\Http\Requests\produccion\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'lider_de_pedido_produccion' => 'required|max:80',
      'comentario_produccion'      => 'nullable|max:30000|string',
    ];
  }
}
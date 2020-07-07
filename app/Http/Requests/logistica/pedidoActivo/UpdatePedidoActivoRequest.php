<?php
namespace App\Http\Requests\logistica\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'comentario_logistica'      => 'nullable|max:30000|string',
    ];
  }
}
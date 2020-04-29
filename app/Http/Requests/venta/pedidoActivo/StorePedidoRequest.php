<?php
namespace App\Http\Requests\venta\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'serie'               => 'required|exists:series,value',
      'cliente'             => 'required|exists:users,id',
      'total_de_armados'    => 'required|min:0|max:99999999999|numeric',
      'monto_total'         => 'required|min:0|numeric|alpha_decimal15',
      'es_entrega_express'  => 'required|in:Si,No',
      'es_pedido_urgente'   => 'required|in:Si,No',
      'plantilla'           => 'nullable|required_if:checkbox_correo,on|exists:plantillas,id',
      'checkbox_correo'     => 'in:on,off',
    ];
  }
}
<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeEntregaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'numero_de_guia'          => 'required_if:metodo_de_entrega,Paquetería|max:60',
      'costo_por_envio'         => 'nullable|min:0|numeric|alpha_decimal18',
      'comprobante_de_entrega'  => 'required|image',
    ];
  }
}
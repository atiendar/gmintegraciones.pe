<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeEntregaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'cantidad'                      => 'required|numeric|max:9999999999',
      'metodo_de_entrega'             => 'required',
      'metodo_de_entrega_espesifico'  => 'required',
    //  'comprobante_de_salida'         => 'required|image'
    ];
  }
}
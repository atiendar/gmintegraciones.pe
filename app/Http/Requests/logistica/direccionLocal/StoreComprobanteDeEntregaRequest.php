<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeEntregaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $aaaa =  $this->metodo_de_entrega;
    $sss =  $this->metodo_de_entrega_espesifico;
    if($this->metodo_de_entrega == 'Transportes Ferro') {
      // |nullable|exists:metodos_de_entrega_especificos,nom_met_ent_esp
      return [
        'metodo_de_entrega_espesifico'  => 'required_if:metodo_de_entrega,Transportes Ferro',
        'paqueteria'                    => 'required_if:metodo_de_entrega_espesifico,Paquetería',
        'numero_de_guia'                => 'required_if:metodo_de_entrega_espesifico,Paquetería|max:60',
        'comprobante_de_entrega'        => 'required|image',
      ];
    }else {
      return [
        'numero_de_guia'          => 'required_if:metodo_de_entrega,Paquetería|max:60',
        'comprobante_de_entrega'  => 'required|image',
      ];
    }
  }
}
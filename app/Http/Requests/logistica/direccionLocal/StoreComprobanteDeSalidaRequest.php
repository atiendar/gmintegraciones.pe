<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeSalidaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $direccion = \App\Models\PedidoArmadoTieneDireccion::with('comprobantes')->findOrFail($this->id_direccion);
    $cant_comprobantes = $direccion->comprobantes()->sum('cant');
    $max = $direccion->cant - $cant_comprobantes;
    return [
      'cantidad'                      => 'required|numeric|min:1|max:'.$max,
      'metodo_de_entrega'             => 'required|exists:metodos_de_entrega,nom_met_ent',
      'metodo_de_entrega_espesifico'  => 'required_if:metodo_de_entrega,Paquetería,Transporte interno de la empresa,Transportes Ferro,Viaje metropolitano (Uber, Didi, Beat...)',
      'comprobante_de_salida'         => 'nullable|image'
    ];
  }
}
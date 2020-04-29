<?php
namespace App\Http\Requests\venta\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    if($this->cot_fin_de_client_nom == NULL) {
      return [
        'fecha_de_entrega'                  => 'required|date',
        'cotizacion_final_del_cliente'      => 'required|mimes:pdf,jpg,jpeg,png|max:1024',
        'se_puede_entregar_antes'           => 'required|in:Si,No',
        'cuantos_dias_antes'                => 'nullable|required_if:se_puede_entregar_antes,Si|max:999|min:1|integer',
        'comentarios_ventas'                => 'nullable|max:65500|string',
      ];
    } elseif($this->cot_fin_de_client_nom != NULL) {
      return [
        'fecha_de_entrega'                  => 'required|date',
        'cotizacion_final_del_cliente'      => 'mimes:pdf,jpg,jpeg,png|max:1024',
        'se_puede_entregar_antes'           => 'required|in:Si,No',
        'cuantos_dias_antes'                => 'nullable|required_if:se_puede_entregar_antes,Si|max:999|min:1|integer',
        'comentarios_ventas'                => 'nullable|max:65500|string',
      ];
    }
  }
}
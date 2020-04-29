<?php
namespace App\Http\Requests\venta\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('tot_de_arm', 'arm_carg')->findOrFail($id_pedido);
    $arm_permitidos = $pedido->tot_de_arm - $pedido->arm_carg;
    return [
      'registrar_armados_por' => 'required|in:Manual,Cotización',
      'cantidad'              => 'nullable|required_if:registrar_armados_por,Manual|max:'.$arm_permitidos.'|min:1|integer',
      'es_de_regalo'          => 'nullable|required_if:registrar_armados_por,Manual|in:Si,No',
      'armado'                => 'nullable|required_if:registrar_armados_por,Manual|exists:armados,id',
      'cotizacion'            => 'nullable|required_if:registrar_armados_por,Cotización|exists:cotizaciones,id',
      'comentarios_ventas'    => 'nullable|max:65500|string',
    ];
  }
}
<?php
namespace App\Http\Requests\venta\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateMontoTotalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('id')->with('pagos')->findOrFail($id_pedido);
    $min_monto = $pedido->pagos()->sum('mont_de_pag');
    return [
      'monto_total'   => 'required|min:'.$min_monto.'|numeric|alpha_decimal15',
    ];
  }
}
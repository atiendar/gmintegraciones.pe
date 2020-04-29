<?php
namespace App\Http\Requests\venta\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateTotalDeArmadosRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('id')->with('armados')->findOrFail($id_pedido);
    $min_armados = $pedido->armados()->sum('cant');
    return [
      'total_de_armados'  => 'required|min:'.$min_armados.'|max:99999999999|numeric',
    ];
  }
}
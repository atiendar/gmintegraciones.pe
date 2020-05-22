<?php
namespace App\Http\Requests\almacen\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    return [
        'lider_de_pedido_almacen'    => 'required|max:80'. $id_pedido,
    ];
  }
}
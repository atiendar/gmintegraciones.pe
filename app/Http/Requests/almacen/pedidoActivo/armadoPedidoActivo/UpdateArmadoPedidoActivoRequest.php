<?php
namespace App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
// Otros

class UpdateArmadoPedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
        'estatus'              => 'required|in:En espera de compra,En revisión de productos,Cancelado',
    ];
  }
}
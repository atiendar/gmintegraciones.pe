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
      'estatus'              => 'required|in:'.config('app.en_espera_de_compra').','.config('app.en_revision_de_productos').','.config('app.productos_completos'),
      'comentario_almacen'   => 'nullable|max:65500|string',
    ];
  }
}
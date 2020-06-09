<?php
namespace App\Http\Requests\pago;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdatePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus_pago'  => 'required|in:Aprobado,Rechazado',
      'comentarios'   => 'nullable|required_if:estatus_pago,Rechazado|max:30000|string',    
    ];
  }
}
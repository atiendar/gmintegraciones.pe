<?php
namespace App\Http\Requests\cotizacion;
use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'serie'               => 'required|exists:series,value',
      'validez'             => 'required|date|after:tomorrow',
      'correo_del_cliente'  => 'required|exists:users,email_registro',
    ];
  }
}
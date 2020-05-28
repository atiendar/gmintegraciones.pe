<?php
namespace App\Http\Requests\sistema\plantilla;
use Illuminate\Foundation\Http\FormRequest;

class StorePlantillaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_de_la_plantilla'	=> 'required|max:100|unique:plantillas,nom',
      'modulo'                  => 'required|in:Clientes (Bienvenida),Perfil (Cambio de contraseña),Sistema (Restablecimiento de contraseña),Usuarios (Bienvenida),Cotizaciones (Términos y condiciones),Ventas (Registrar pedido),Ventas (Pedido cancelado),Pagos (Registrar pago),Pagos (Pago rechazado)',
      'asunto'                  => 'required|max:100',
    ];
  }
}
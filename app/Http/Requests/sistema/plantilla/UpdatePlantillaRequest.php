<?php
namespace App\Http\Requests\sistema\plantilla;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdatePlantillaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_plantilla = Crypt::decrypt($this->id_plantilla);
    return [
      'nombre_de_la_plantilla'	=> 'required|max:100|unique:plantillas,nom,' . $id_plantilla ,
      'modulo'                  => 'required|in:Cotizaciones,Clientes,Perfil,Sistema,Usuarios,Ventas',
      'asunto'                  => 'required|max:100',
      'diseno_de_la_plantilla'  => 'required',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'diseno_de_la_plantilla'    => 'diseño de la plantilla',
    ];
  }
}
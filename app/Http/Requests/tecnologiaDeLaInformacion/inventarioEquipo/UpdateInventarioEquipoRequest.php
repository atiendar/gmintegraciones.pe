<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioEquipoRequest extends FormRequest {
    public function authorize() {
        return true;
      }
      public function rules() {
          return [
            'empresa'  => 'required|max:80',
            'responsable' =>  'required|max:80',
            'numero_serie' =>  'required|max:80',
            'marca'    => 'required|max:80',
            'modelo'   =>  'required|max:80',
          ];
      }
}

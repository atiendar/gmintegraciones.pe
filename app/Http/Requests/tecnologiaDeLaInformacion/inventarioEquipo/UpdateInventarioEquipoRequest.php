<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioEquipoRequest extends FormRequest {
    public function authorize() {
        return true;
      }
      public function rules() {
          return [
            'empresa'      =>  'required|max:100',
            'responsable'  =>  'required|max:80',
            'numero_serie' =>  'required|max:40',
            'marca'        =>  'required|max:50',
            'modelo'       =>  'required|max:50',
          ];
      }
}

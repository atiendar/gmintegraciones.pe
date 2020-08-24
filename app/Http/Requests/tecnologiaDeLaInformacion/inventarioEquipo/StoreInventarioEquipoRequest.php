<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioEquipoRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'id_del_equipo'      =>  'required|max:25|unique:inventario_equipos,id_equipo',
            'empresa'            =>  'required|max:80',
            'responsable'        =>  'required|max:80',
            'numero_serie'       =>  'required|max:40',
            'marca'              =>  'required|max:50',
            'modelo'             =>  'required|max:50',
            'archivo'            =>  'nullable|array',
            'archivos.*'         =>  'nullable|max:1024',
        ];
    }
}
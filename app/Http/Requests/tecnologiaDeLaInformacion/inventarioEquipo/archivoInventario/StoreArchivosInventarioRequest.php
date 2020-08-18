<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo\archivoInventario;
use Illuminate\Foundation\Http\FormRequest;

class  StoreArchivosInventarioRequest extends  FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            "archivos"     =>    "required|array",
            "archivos.*"   =>    "required|image|max:1024",
        ];
    }
} 
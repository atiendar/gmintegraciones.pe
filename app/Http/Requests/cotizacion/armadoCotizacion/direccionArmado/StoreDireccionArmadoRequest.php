<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado;
use Illuminate\Foundation\Http\FormRequest;

class StoreDireccionArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = $this->id_armado; // Este id se recibe desencriptado
    $armado = \App\Models\CotizacionArmado::select('cant', 'cant_direc_carg')->findOrFail($id_armado);
    $dir_permitidas = $armado->cant - $armado->cant_direc_carg;
    return [
    /*
    * SOLO HACE LA VALIDACION REQUIRED DE ESTOS CAMPOS PARA OBLIGAR AL USUARIO A SELECCIONAR UN 
    * COSTO DE ENVIO YA QUE DICHA VALIDACION DE ESTOS CAMPOS SE HACE DESDE EL MODULO COSTOS DE ENVIO
    */
      'costo_seleccionado'        => 'required',
      'cantidad'                  => 'required|numeric|min:0|max:'.$dir_permitidas,
      'detalles_de_la_ubicacion'  => 'required|max:150',
      
    ];
  }
  public function messages() {
    return [
      // Mensaje que se muestra en las diferentes validaciones, por ejemplo "required, max: min: ...".
       'costo_seleccionado.required' => 'No se ha seleccionado ningún :attribute',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'costo_seleccionado'    => 'costo de envío',
    ];
  }
}
/*
'metodo_de_entrega'         => 'required|in:En bodega,Gratis,Paquetería,Transporte interno de la empresa,Transportes ferro,Viaje metropolitano',
'estado_al_que_se_cotizo'   => 'required|in:Aguascalientes,Baja California,Baja California Sur,Campeche,Ciudad de México,Chihuahua,Chiapas,Coahuila de Zaragoza,Colima,Durango,Estado de México,Guanajuato,Guerrero,Hidalgo,Jalisco,Michoacán de Ocampo,Morelos,Nayarit,Nuevo León,Oaxaca,Puebla,Querétaro,Quintana Roo,San Luis Potosí,Sinaloa,Sonora,Tabasco,Tamaulipas,Tlaxcala,Veracruz,Yucatán,Zacatecas',
'foraneo_o_local'           => 'required|in:Foráneo,Local',
'tipo_de_envio'             => 'required|in:Normal,Express',
'costo_de_envio'            => 'required|min:0|numeric|alpha_decimal15',
*/
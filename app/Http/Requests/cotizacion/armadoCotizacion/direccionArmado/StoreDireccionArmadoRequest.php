<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreDireccionArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = Crypt::decrypt($this->id_armado);
    $armado = \App\Models\CotizacionArmado::select('cant', 'cant_direc_carg')->findOrFail($id_armado);
    $dir_permitidas = $armado->cant - $armado->cant_direc_carg;
    return [
      'cantidad'                  => 'required|min:0|max:'.$dir_permitidas.'|numeric',
      'metodo_de_entrega'         => 'required|in:En bodega,Gratis,Paquetería,Transporte interno de la empresa,Transportes ferro,Viaje metropolitano',
      'estado_al_que_se_cotizo'   => 'required|in:Aguascalientes,Baja California,Baja California Sur,Campeche,Ciudad de México,Chihuahua,Chiapas,Coahuila de Zaragoza,Colima,Durango,Estado de México,Guanajuato,Guerrero,Hidalgo,Jalisco,Michoacán de Ocampo,Morelos,Nayarit,Nuevo León,Oaxaca,Puebla,Querétaro,Quintana Roo,San Luis Potosí,Sinaloa,Sonora,Tabasco,Tamaulipas,Tlaxcala,Veracruz,Yucatán,Zacatecas',
      'detalles_de_la_ubicacion'  => 'required|max:100',
      'tipo_de_envio'             => 'required|in:Normal,Express',
      'costo_de_envio'            => 'required|min:0|numeric|alpha_decimal15',
    ];
  }
}
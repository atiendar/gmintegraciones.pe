<?php
namespace App\Http\Requests\costoDeEnvio;
use Illuminate\Foundation\Http\FormRequest;

class StoreCostoDeEnvioRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'tipo_de_empaque'   => 'required|in:Cuenta con caja de cartón,No cuenta con caja de cartón',
      'cuenta_con_seguro' => 'required|in:Si,No',
      'tiempo_de_entrega' => 'required|numeric|max:999999999999999',
      'estado'            => 'required|in:Aguascalientes,Baja California,Baja California Sur,Campeche,Ciudad de México,Chihuahua,Chiapas,Coahuila de Zaragoza,Colima,Durango,Estado de México,Guanajuato,Guerrero,Hidalgo,Jalisco,Michoacán de Ocampo,Morelos,Nayarit,Nuevo León,Oaxaca,Puebla,Querétaro,Quintana Roo,San Luis Potosí,Sinaloa,Sonora,Tabasco,Tamaulipas,Tlaxcala,Veracruz,Yucatán,Zacatecas',
      'metodo_de_entrega' => 'required|in:En bodega,Gratis,Paquetería,Transporte interno de la empresa,Transportes ferro,Viaje metropolitano',
      'foraneo_o_local'   => 'required|in:Foráneo,Local',
      'tipo_de_envio'     => 'required|in:Normal,Express,Consolidado',
      'costo_por_envio'   => 'required|min:0|numeric|alpha_decimal15',
    ];
  }
}

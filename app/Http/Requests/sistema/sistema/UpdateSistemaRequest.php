<?php
namespace App\Http\Requests\sistema\sistema;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSistemaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_de_la_empresa'                      => 'required|max:200',
      'nombre_de_la_empresa_abreviado'            => 'required|max:50',
      'year_de_inicio'                            => 'required|date',
      'version_del_sistema'                       => 'max:10',
      'lada_telefono_fijo'                        => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'                             => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'                                 => 'required|max:10',
      'lada_telefono_movil'                       => 'nullable|max:9999|min:1|numeric|required_with:telefono_movil',
      'telefono_movil'                            => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_movil',
      'direccion_uno'                             => 'required|max:500',
      'direccion_dos'                             => 'max:500',
      'direccion_tres'                            => 'max:500',
      'correo_ventas'                             => 'required|max:75|email',
      'correo_opcion_uno'                         => 'nullable|max:75|email',
      'correo_opcion_dos'                         => 'nullable|max:75|email',
      'correo_opcion_tres'                        => 'nullable|max:75|email',
      'pagina_web'                                => 'required|max:100|active_url',
      'facebook'                                  => 'nullable|max:100|active_url',
      'twitter'                                   => 'nullable|max:100|active_url',
      'instagram'                                 => 'nullable|max:100|active_url',
      'linkedin'                                  => 'nullable|max:100|active_url',
      'plantilla_por_default_modulo_usuarios'     => 'required|exists:plantillas,id',
      'plantilla_por_default_modulo_clientes'     => 'required|exists:plantillas,id',
      'plantilla_por_default_modulo_perfil'       => 'required|exists:plantillas,id',
      'plantilla_por_default_restaurar_password'  => 'required|exists:plantillas,id',
      'logo_color_negro'                          => 'nullable|max:1024|image',
      'logo_color_blanco'                         => 'nullable|max:1024|image',
      'imagen_login'                              => 'nullable|max:1024|image',
      'imagen_restablecer_la_contraseña'          => 'nullable|max:1024|image',
      'imagen_nueva_contraseña'                   => 'nullable|max:1024|image',
      'imagen_predeterminada_del_perfil'          => 'nullable|max:1024|image',
      'imagen_modulo_en_desarrollo'               => 'nullable|max:1024|image',
      'imagen_error'                              => 'nullable|max:1024|image',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'plantilla_por_default_restaurar_password'    => 'Plantilla por default restaurar contraseña',
      'year_de_inicio'                              => 'año de inicio',
    ];
  }
}
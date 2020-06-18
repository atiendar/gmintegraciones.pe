<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider {
  public function register() {
    //
  }
  public function boot() {
    Schema::defaultStringLength(120); // Longitud maxima de los campos en la base de datos esto es al generar las migraciones
    Validator::extend('alpha_solo_espacios_letras_punto', function ($attribute, $value) { // Validación
        return preg_match('/^[\pL\s\.]+$/u', $value); 
    });
    Validator::extend('alpha_solo_puntos_y_letras', function ($attribute, $value) { // Validación
        return preg_match('/^([a-z\.]{0,61})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros_guiones', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\-]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_decimal15', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,15})?$/', $value); 
    });
    Validator::extend('alpha_decimal18', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,18})?$/', $value); 
    });
    Validator::extend('alpha_decimal7', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,7})?$/', $value); 
    });
    Validator::extend('alpha_cierre_fiscal', function ($attribute, $value) { // Validación
      $year_actual = date("Y");
      $pago = \App\Models\Pago::where('cod_fact', $value)->firstOrFail('created_at');

      if($pago->created_at->format('Y') < $year_actual) {
        return false;
      }
      return true; 
    });
    Validator::extend('alpha_unique_where', function ($attribute, $value, $otros) { // Validación
        $tabla  = $otros['0'];
        $inpu   = $otros['1'];
        if(isset($otros['2'])                 ){
            $consul     = 'AND id <>' . $otros['2'];
        } else {
            $consul     = null;
        }
        $resultado = \DB::SELECT("SELECT * FROM $tabla WHERE $attribute = '$value' AND input = '$inpu' $consul");
        if(sizeof($resultado)) {
            return false;
        }
        return true; 
    });
    Validator::extend('alpha_codigo_de_facturacion_pertenece_al_usuario', function ($attribute, $value, $user_id) { // Validación
      $resultado = \App\Models\Pago::where('cod_fact', $value)->firstOrFail('user_id');

      if($resultado->user_id != $user_id[0]) {
        return false;
      }
      return true; 
    });
    Validator::extend('alpha_estatus_codigo_de_facturacion', function ($attribute, $value) { // Validación
      $resultado = \App\Models\Pago::where('cod_fact', $value)->firstOrFail('est_fact');

      if($resultado->est_fact != config('app.no_solicitada') AND $resultado->est_fact != config('app.cancelado')) {
        return false;
      }
      return true; 
    });
  }
}
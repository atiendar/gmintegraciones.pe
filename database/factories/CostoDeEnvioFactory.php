<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CostoDeEnvio;
use Faker\Generator as Faker;
use App\User;
use App\Models\Estado;
use App\Models\MetodoDeEntrega;
use App\Models\TipoDeEnvio;
// nom_met_ent
$factory->define(CostoDeEnvio::class, function (Faker $faker) {
  $usuario            = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
  $estado             = $faker->randomElement(Estado::pluck('est'));
  $metodo_de_entrega  = $faker->randomElement(MetodoDeEntrega::pluck('nom_met_ent'));
  $tipo_de_envio      = $faker->randomElement(TipoDeEnvio::pluck('tip_de_env'));

  $randomDigit        = $faker->randomDigit();
  return [
    'seg'             => $faker->randomElement(config('opcionesSelect.select_si_no')),
    'tam'             => $faker->randomElement(config('opcionesSelect.select_tamano')),
    'tiemp_ent'       => 'De '.$randomDigit.' a '.($randomDigit+2).' dias',
    'met_de_entreg'   => $metodo_de_entrega,
    'est'             => $estado,
    'for_loc'         => $faker->randomElement(config('opcionesSelect.select_foraneo_local')),
    'tip_env'         => $tipo_de_envio,
    'cost_por_env'    => $faker->randomFloat(2, 5, 20),
    'asignado_env'    => $usuario,
    'created_at_env'  => $usuario,
  ];
});
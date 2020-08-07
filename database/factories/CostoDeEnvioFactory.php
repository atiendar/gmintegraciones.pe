<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CostoDeEnvio;
use Faker\Generator as Faker;
use App\User;
use App\Models\Estado;

$factory->define(CostoDeEnvio::class, function (Faker $faker) {
  $usuario    = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
  $estado    = $faker->randomElement(Estado::pluck('est'));

  return [
    'tip_emp'         => $faker->randomElement(config('opcionesSelect.select_tipo_de_empaque')),
    'seg'             => $faker->randomElement(config('opcionesSelect.select_si_no')),
    'tam'             => $faker->randomElement(config('opcionesSelect.select_tamano')),
    'tiemp_ent'       => $faker->randomDigit(),
    'met_de_entreg'   => $faker->randomElement(config('opcionesSelect.select_metodo_de_entrega')),
    'est'             => $estado,
    'for_loc'         => $faker->randomElement(config('opcionesSelect.select_foraneo_local')),
    'tip_env'         => $faker->randomElement(config('opcionesSelect.select_tipo_de_envio_plus')),
    'cost_por_env'    => $faker->randomFloat(2, 5, 20),
    'asignado_env'    => $usuario,
    'created_at_env'  => $usuario,
  ];
});
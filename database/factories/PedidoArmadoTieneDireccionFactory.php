<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PedidoArmadoTieneDireccion;
use App\User;
use App\Models\PedidoArmado;
use App\Models\MetodoDeEntrega;
use Faker\Generator as Faker;

$factory->define(PedidoArmadoTieneDireccion::class, function (Faker $faker) {
  $usuario            = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
  $armado             = $faker->randomElement(PedidoArmado::pluck('id'));
  $metodo_de_entrega  = $faker->randomElement(MetodoDeEntrega::pluck('nom_met_ent'));
  return [
    'cant'                      => $faker->randomElement([1,2,3,4]),
    'estat'                     => $faker->randomElement([config('app.pendiente'), config('app.en_almacen_de_salida')]),
    'met_de_entreg'             => $metodo_de_entrega,
    'est'                       => $faker->randomElement(config('opcionesSelect.select_estado')),
    'for_loc'                   => $faker->randomElement(config('opcionesSelect.select_foraneo_local')),
    'detalles_de_la_ubicacion'  => $faker->paragraph,
    'tip_env'                   => $faker->randomElement(config('opcionesSelect.select_tipo_de_envio_plus')),
    'pedido_armado_id'          => $armado,
    'created_at_direc_arm'      => $usuario,
  ];
});

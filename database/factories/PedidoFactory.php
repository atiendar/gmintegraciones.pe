<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Serie;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    $cliente_id = $faker->randomElement(User::where('acceso', '2')->pluck('id'));
    $usuario    = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    $serie      = $faker->unique()->randomElement(Serie::where('input', 'Pedidos (Serie)')->pluck('value'));
    return [
        'serie'                 => $serie,
        'num_pedido'            => $serie,
        'user_id'               => $cliente_id,
        'tot_de_arm'            => 0,
        'mont_tot_de_ped'       => $faker->randomFloat(2, 100, 3000),
        'entr_xprs'             => $faker->randomElement(config('opcionesSelect.select_entrega_express')),
        'estat_vent_arm'        => config('app.armados_cargados'),
        'estat_alm'             => config('app.asignar_lider_de_pedido'),
        'fech_estat_alm'        => date('Y-m-d h:i:s'),
        'estat_produc'          => config('app.asignar_lider_de_pedido'),
        'fech_estat_produc'     => date('Y-m-d h:i:s'),
        'estat_log'             => config('app.asignar_lider_de_pedido'),
        'fech_estat_log'        => date('Y-m-d h:i:s'),
        'asignado_ped'  	      => $usuario,
        'created_at_ped'        => $usuario,
    ];
});
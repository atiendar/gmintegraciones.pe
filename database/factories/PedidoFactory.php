<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Serie;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    $cliente_id = $faker->randomElement(User::where('acceso', '2')->get()->pluck('id'));
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    $serie = $faker->unique()->randomElement(Serie::where('input', 'Pedidos (Serie)')->pluck('value'));
    return [
        'serie'                 => $serie,
        'num_pedido'            => $serie,
        'user_id'               => $cliente_id,
        'tot_de_arm'            => $faker->numberBetween(1, 999),
        'mont_tot_de_ped'       => $faker->randomFloat(2, 100, 3000),
        'entr_xprs'             => $faker->randomElement(array('Si', 'No')),
        'asignado_ped'  	    => $usuario,
        'created_at_ped'        => $usuario,
    ];
});

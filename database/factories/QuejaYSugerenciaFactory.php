<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuejaYSugerencia;
use App\User;
use Faker\Generator as Faker;

$factory->define(QuejaYSugerencia::class, function (Faker $faker) {
    $cliente = $faker->randomElement(User::all());
    return [
        'depto'     => $faker->randomElement(['Ventas', 'Producción', 'Logística']),
        'obs'       => 'Pesimo servicio',
        'user_id'   => $cliente->id,
    ];
});

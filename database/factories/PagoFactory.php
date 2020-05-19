<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Pedido;
use App\Models\Pago;
use Faker\Generator as Faker;

$factory->define(Pago::class, function (Faker $faker) {
    $pedido = $faker->randomElement(Pedido::get());
    return [
        'pedido_id' => $pedido->id,
    ];
});

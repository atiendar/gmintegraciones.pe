<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Pago;
use Faker\Generator as Faker;

$factory->define(Pago::class, function (Faker $faker) {
    $pedido = $faker->randomElement(Pedido::get());
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    return [
        'serie'             => $pedido->serie,
        'cod_fact'          => $faker->unique()->numberBetween(999, 99999999999),
        'comp_de_pag_rut'   => $faker->url,
        'comp_de_pag_nom'   => $faker->url,
        'mont_de_pag'       => $faker->numberBetween(1, 999),
        'tipo'              => 'Anticipo',
        'form_de_pag'       => $faker->randomElement(array('Transferencia', 'Efectivo')),
        'pedido_id'         => $pedido->id,
        'created_at_pag'    => $usuario,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pago;
use App\Models\SubPago;
use Faker\Generator as Faker;

$factory->define(SubPago::class, function (Faker $faker) {
    $pago = $faker->randomElement(Pago::get());
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    return [
        'cod_fact'              => $faker->unique()->numberBetween(999, 99999999999),
        'comp_de_pag_rut'       => $faker->url,
        'comp_de_pag_nom'       => $faker->url,
        'mont_de_pag'           => $faker->numberBetween(1, 999),
        'form_de_pag'           => $faker->randomElement(array('Transferencia', 'Efectivo')),
        'pago_id'               => $pago->id,
        'created_at_sub_pag'    => $usuario,
    ];
});

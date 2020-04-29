<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pago;
use App\Models\Factura;
use App\Models\Serie;
use Faker\Generator as Faker;

$factory->define(Factura::class, function (Faker $faker) {
    $cliente = $faker->randomElement(User::where('acceso', '2')->get());
    $pago = $faker->unique()->randomElement(Pago::get());
    $consepto = array('Arcon Navideño','Canastas Navideñas','Despensas','Regalo de fin de año');
    return [
        'serie'             => $pago->serie,
        'nom_o_raz_soc'     => $faker->name,
        'rfc'               => $faker->numberBetween(1, 9999),
        'lad_mov'           => $faker->numberBetween(1, 9999),
        'tel_mov'           => $faker->numberBetween(11111111, 999999999999),
        'lad_fij'           => $faker->numberBetween(1, 9999),
        'tel_fij'           => $faker->numberBetween(11111111, 999999999999),
        'calle'             => $faker->name,
        'no_ext'            => $faker->numberBetween(1, 9999),
        'pais'  			=> $faker->name,
        'ciudad'     	    => $faker->name,
        'col'               => $faker->name,
        'del_o_munic'       => $faker->name,
        'cod_post'          => $faker->numberBetween(1, 9999),
        'preg'              => 'No',
        'uso_de_cfdi'       => 'G03 Gastos en general',
        'met_de_pag'        => 'PUE Pago en una sola exhibición',
        'form_de_pag'       => '28 Tarjeta de débito',
        'concept'           => $faker->randomElement($consepto),
    //    'mont_a_fact'       => $pago->mont_de_pag,
        'pago_id'           => $pago->id,
        'created_at_fact'   => $cliente->email_registro,
    ];
});

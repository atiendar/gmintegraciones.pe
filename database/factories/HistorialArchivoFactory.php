<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Historial;
use App\Models\HistoialArchivo;
use Faker\Generator as Faker;

$factory->define(HistoialArchivo::class, function (Faker $faker) {
    $historial_id = $faker->randomElement(Historial::pluck('id'));
    return [
        'his_arch_rut'      =>  $faker->text,
        'his_arch'          =>  $faker->text,
        'historial_id'      =>  $historial_id,
    ];
});

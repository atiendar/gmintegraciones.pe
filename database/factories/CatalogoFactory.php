<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Catalogo;
use App\User;
use Faker\Generator as Faker;

$factory->define(Catalogo::class, function (Faker $faker) {
    $input          = $faker->randomElement(['Armados (Gama)', 'Armados (Tipo)', 'Productos (Categoría)', 'Productos (Etiqueta)', 'Soportes (Agrupación de fallas)']);
    $value_vista    = $faker->jobTitle;
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    return [
        'input'             => $input,
        'value'             => $value_vista,
        'vista'             => $value_vista,
        'asignado_cat'      => $usuario,
        'created_at_cat'    => $usuario
    ];
});

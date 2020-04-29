<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Plantilla::class, function (Faker $faker) {
    $modulos = array('Cotizaciones', 'Clientes', 'Perfil', 'Sistema', 'Usuarios', 'Ventas');
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    
    return [
        'nom'               => $faker->unique()->name,
        'mod'				=> $faker->randomElement($modulos),
        'asunt'             => 'Indefinido',
        'dis_de_la_plant'   => $faker->paragraph,
        'asignado_plan'     => $usuario,
        'created_at_plan'   => $usuario
    ];
});
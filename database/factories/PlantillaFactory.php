<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Plantilla::class, function (Faker $faker) {
    $modulos = array('Clientes (Bienvenida)', 'Perfil (Cambio de contraseña)', 'Sistema (Restablecimiento de contraseña)', 'Usuarios (Bienvenida)', 'Cotizaciones (Términos y condiciones)', 'Ventas (Registrar pedido)', 'Ventas (Pedido cancelado)', 'Pagos (Registrar pago)', 'Pagos (Pago rechazado)');
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
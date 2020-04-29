<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    $correo = $faker->unique()->safeEmail;
    $opc_sidebar = array(null, 'sidebar-collapse');
    $opc_lang = array('es', 'en');
    $opc_col_barr_de_naveg = array('navbar-dark navbar-primary', 'navbar-dark navbar-secondary', 'navbar-dark navbar-info', 'navbar-dark navbar-success', 'navbar-dark navbar-danger', 'navbar-dark navbar-indigo', 'navbar-dark navbar-purple', 'navbar-dark navbar-pink', 'navbar-dark navbar-teal', 'navbar-dark navbar-cyan', 'navbar-dark', 'navbar-dark navbar-gray-dark', 'navbar-dark navbar-gray', 'navbar-light', 'navbar-light navbar-warning', 'navbar-light navbar-white', 'navbar-light navbar-orange');
    $opc_col_barr_lat_oscu_o_clar = array('sidebar-dark-primary', 'sidebar-dark-warning', 'sidebar-dark-info', 'sidebar-dark-danger', 'sidebar-dark-success', 'sidebar-dark-indigo', 'sidebar-dark-navy', 'sidebar-dark-purple', 'sidebar-dark-fuchsia', 'sidebar-dark-pink', 'sidebar-dark-maroon', 'sidebar-dark-orange', 'sidebar-dark-lime', 'sidebar-dark-teal', 'sidebar-dark-olive', 'sidebar-light-primary', 'sidebar-light-warning', 'sidebar-light-info', 'sidebar-light-danger', 'sidebar-light-success', 'sidebar-light-indigo', 'sidebar-light-navy', 'sidebar-light-purple', 'sidebar-light-fuchsia', 'sidebar-light-pink', 'sidebar-light-maroon', 'sidebar-light-orange', 'sidebar-light-lime', 'sidebar-light-teal', 'sidebar-light-olive');
    $opc_col_logot = array('navbar-primary', 'navbar-secondary', 'navbar-info', 'navbar-success', 'navbar-danger', 'navbar-indigo', 'navbar-purple', 'navbar-pink', 'navbar-teal', 'navbar-cyan', 'navbar-dark', 'navbar-gray-dark', 'navbar-gray', 'navbar-light', 'navbar-warning', 'navbar-white', 'navbar-orange');
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    return [
        'acceso'                    => $faker->randomElement(['1', '2']),
        'nom' 				        => $faker->name,
        'apell' 			        => $faker->lastName,
        'email_registro'            => $correo,
        'email' 			        => $correo,
        'email_secund'              => $faker->safeEmail,
        'lad_mov'                   => $faker->numberBetween(1, 9999),
        'tel_mov'                   => $faker->numberBetween(11111111, 999999999999),
        'lad_fij'                   => $faker->numberBetween(1, 9999),
        'tel_fij'                   => $faker->numberBetween(11111111, 999999999999),
        'ext'                       => $faker->numberBetween(1, 99999),
        'emp'                       => $faker->title,
        'email_verified_at'         => NULL,
        'password' 			        => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' 	        => Str::random(10),
        'obs'                       => $faker->paragraph,
        'lang'                      => $faker->randomElement($opc_lang),
        'sidebar'                   => $faker->randomElement($opc_sidebar),
        'col_barr_de_naveg'         => $faker->randomElement($opc_col_barr_de_naveg),
        'col_barr_lat_oscu_o_clar'  => $faker->randomElement($opc_col_barr_lat_oscu_o_clar),
        'col_logot'                 => $faker->randomElement($opc_col_logot),
        'asignado_us'  	            => $usuario,
        'created_at_us'             => $usuario,
    ];
});
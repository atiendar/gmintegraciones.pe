<?php
use Illuminate\Database\Seeder;

class SistemaTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\Sistema::create([
          'id'                    => 1,
          'log_neg_rut'		        => env('PREFIX'),
          'log_neg'			          => 'sistema/gBO17Mfr0UQsz49ATXOW4MacfV2LBKu8BxK1qvid.png',
          'log_blan_rut'		      => env('PREFIX'),
          'log_blan'			        => 'sistema/0HgNRUVMaJ9hAZqZtsMtcbpQo25hooVYJHDcmjP7.png',
          'carrus_login_rut'      => env('PREFIX'),
          'carrus_login'          => 'sistema/carrusel-login-1582134710.png',
          'carrus_reque_rut'      => env('PREFIX'),
          'carrus_reque'          => 'sistema/carrusel-request-1582134710.png',
          'carrus_rese_rut'       => env('PREFIX'),
          'carrus_rese'           => 'sistema/carrusel-reset-1582134710.png',
          'defau_img_perf_rut'    => env('PREFIX'),
          'defau_img_perf'        => 'sistema/default-perfil-1582134710.png',
          'img_construc_rut'      => env('PREFIX'),
          'img_construc'          => 'sistema/en-construccion-1582134710.png',
          'error_rut'             => env('PREFIX'),
          'error'                 => 'sistema/error-1582134710.png',
          'emp'				            => 'GM INTEGRACIONES Y SOLUCIONES EN CONTROL S.A DE C.V',
          'emp_abrev'			        => 'GM Integraciones',
          'year_de_ini'           => '2015-01-01',
          'lad_fij'			          => '55',
          'tel_fij'			          => '71596103',
          'ext'				            => '100',
          'direc_uno'             => 'Blvrd Manuel Ávila Camacho 80, Int 204, El Parque, 53398 Naucalpan de Juárez, MEX',
          'corr_vent'			        => 'ventas@gmintegraciones.com',
          'pag'				            => 'https://gmintegraciones.com/',
          'ser_cotizaciones'      => 'COT-',
          'ser_pedidos'           => 'GM-',
          'plant_usu_bien'        => 1,
          'plant_cli_bien'        => 2,
          'plant_per_camb_pass'   => 3,
          'plant_sis_rest_pass'   => 4,
          'plant_cot_term_cond'   => 5,
          'plant_vent_reg_ped'    => 6,
          'plant_vent_ped_can'    => 7,
          'plant_pag_reg_pag'     => 8,
          'plant_pag_pag_rech'    => 9,
          'plant_fac_generada'    => 10,
          'plant_fac_cancelado'   => 11,
          'plant_fac_err_cli'     => 12,
          'plant_ped_ent'         => 13,
          'created_at_sis'	      => 'desarrolloweb.ewmx@gmail.com',
        ]);
    }
}

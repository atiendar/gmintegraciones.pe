<?php
use Illuminate\Database\Seeder;
use App\Models\Serie;

class SeriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Serie::create([
            'input'             => 'Cotizaciones (Serie)',
            'value'             => 'COT-CYA-',
            'vista'             => 'COT-CYA-',
            'asignado_ser'  	  => 'desarrolloweb.ewmx@gmail.com',
            'created_at_ser'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        Serie::create([
            'input'             => 'Pedidos (Serie)',
            'value'             => 'PED-CYA-',
            'vista'             => 'PED-CYA-',
            'asignado_ser'  	  => 'desarrolloweb.ewmx@gmail.com',
            'created_at_ser'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        factory(Serie::class, 300)->create();
    }
}
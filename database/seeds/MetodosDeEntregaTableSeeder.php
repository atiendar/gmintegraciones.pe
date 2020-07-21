<?php
use Illuminate\Database\Seeder;
use App\Models\MetodoDeEntrega;
class MetodosDeEntregaTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    MetodoDeEntrega::create([
      'id'                  => 1,
      'nom_met_ent'         => 'Paquetería',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 2,
      'nom_met_ent'         => 'Entregado en bodega',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 3,
      'nom_met_ent'         => 'Transporte interno de la empresa',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 4,
      'nom_met_ent'         => 'Transportes Ferro',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 5,
      'nom_met_ent'         => 'Viaje metropolitano (Uber, Didi, Beat...)',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 6,
      'nom_met_ent'         => 'Transportes Vianey',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntrega::create([
      'id'                  => 7,
      'nom_met_ent'         => 'Señor Orlando',
      'asignado_met_ent'  	=> 'desarrolloweb.ewmx@gmail.com',
      'created_at_met_ent'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
  //  factory(MetodoDeEntrega::class, 2)->create();
  }
}

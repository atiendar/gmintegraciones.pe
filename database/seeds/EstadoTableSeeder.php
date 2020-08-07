<?php
use Illuminate\Database\Seeder;
use App\Models\Estado;
class EstadoTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Estado::create([
      'id'              => 1,
      'est'             => 'Aguascalientes',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 2,
      'est'             => 'Baja California',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 3,
      'est'             => 'Baja California Sur',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 4,
      'est'             => 'Campeche',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 5,
      'est'             => 'Ciudad de México',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Local'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 6,
      'est'             => 'Chihuahua',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 7,
      'est'             => 'Chiapas',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 8,
      'est'             => 'Coahuila de Zaragoza',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 9,
      'est'             => 'Colima',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 10,
      'est'             => 'Durango',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 11,
      'est'             => 'Estado de México',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo y Local'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 12,
      'est'             => 'Guanajuato',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 13,
      'est'             => 'Guerrero',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 14,
      'est'             => 'Hidalgo',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 15,
      'est'             => 'Jalisco',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 16,
      'est'             => 'Michoacán de Ocampo',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 17,
      'est'             => 'Morelos',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 18,
      'est'             => 'Nayarit',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 19,
      'est'             => 'Nuevo León',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 20,
      'est'             => 'Oaxaca',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 21,
      'est'             => 'Puebla',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 22,
      'est'             => 'Querétaro',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 23,
      'est'             => 'Quintana Roo',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 24,
      'est'             => 'San Luis Potosí',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 25,
      'est'             => 'Sinaloa',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 26,
      'est'             => 'Sonora',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 27,
      'est'             => 'Tabasco',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 28,
      'est'             => 'Tamaulipas',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 29,
      'est'             => 'Tlaxcala',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 30,
      'est'             => 'Veracruz',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 31,
      'est'             => 'Yucatán',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 32,
      'est'             => 'Zacatecas',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}

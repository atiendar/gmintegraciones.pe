<?php

use Illuminate\Database\Seeder;

class HistorialesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\Historial::class, 5)->create(); 
  }
}

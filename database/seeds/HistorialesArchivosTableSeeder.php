<?php
use Illuminate\Database\Seeder;

class HistorialesArchivosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()    {
      factory(App\Models\HistoialArchivo::class, 5)->create();
  }
}

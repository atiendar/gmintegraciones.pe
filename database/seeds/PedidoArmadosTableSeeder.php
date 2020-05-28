<?php
use Illuminate\Database\Seeder;

class PedidoArmadosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\PedidoArmado::class, 1200)->create();
    }
}

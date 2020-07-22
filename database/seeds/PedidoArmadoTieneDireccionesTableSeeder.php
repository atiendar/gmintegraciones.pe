<?php
use Illuminate\Database\Seeder;

class PedidoArmadoTieneDireccionesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\PedidoArmadoTieneDireccion::class, 1000)->create();
    }
}

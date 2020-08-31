<?php
use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Proveedor::class, 100)->create(); // min
        // factory(App\Models\Proveedor::class, 10000)->create(); // max
    }
}
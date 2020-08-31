<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Producto::class, 1100)->create(); // Nota no puede haber mas armados que productos o fallaran los seeds
        // factory(App\Models\Producto::class, 9000)->create(); // Nota no puede haber mas armados que productos o fallaran los seeds
    }
}

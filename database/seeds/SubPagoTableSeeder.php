<?php
use Illuminate\Database\Seeder;

class SubPagoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\SubPago::class, 500)->create();
    }
}

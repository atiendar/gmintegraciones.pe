<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermisosTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            CatalogosTableSeeder::class,
            SeriesTableSeeder::class,
            PlantillasTableSeeder::class,
            SistemaTableSeeder::class,
            // MÓDULOS
            ProveedoresTableSeeder::class,
            ContactosProveedoresTableSeeder::class,
            ProductosTableSeeder::class,
            ProductoTieneProveedoresTableSeeder::class,
            ProductoTieneSustitutosTableSeeder::class,
            ArmadosTableSeeder::class,
            ArmadoTieneProductosTableSeeder::class,
            CotizacionesTableSeeder::class,
            DireccionesTableSeeder::class,
            DatosFiscalesTableSeeder::class,
            PedidosTableSeeder::class,
            PedidoArmadosTableSeeder::class,
            PagosTableSeeder::class,
            SubPagoTableSeeder::class,
            FacturasTableSeeder::class,
        ]);
    }
}

<?php
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $rol1 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Pruebas',
            'name'              => 'pruebas',
            'desc'              => "Rol para realizar pruebas",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);

        $rol2 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Cliente',
            'name'              => 'cliente',
            'desc'              => "Acceso especial como cliente",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol2->syncPermissions([20]);

        $rol3 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Desarrollador',
            'name'				=> 'desarrollador',
            'desc'              => 'Administrador de todo el sistema',
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);

        $rol4 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Sin acceso al sistema',
            'name'				=> 'sinAccesoAlSistema',
            'desc'              => 'No tiene permiso de acceder al sistema',
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);

        $rol5 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de sistema',
            'name'              => 'adminDeSistema',
            'desc'              => "Acceso a todo el módulo de 'Sistema'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol5->syncPermissions([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]);

        $rol6 = Spatie\Permission\Models\Role::create([
            'nom'				=> "Administrador de sistema 'Nombre de la empresa'",
            'name'              => 'adminDeSistemaNombreDeLaEmpresa',
            'desc'              => "Acceso a todo el módulo de Sistema 'Nombre de la empresa'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol6->syncPermissions([1]);

        $rol7 = Spatie\Permission\Models\Role::create([
            'nom'				=> "Administrador de sistema 'PLantillas'",
            'name'              => 'adminDeSistemaPLantillas',
            'desc'              => "Acceso a todo el módulo de Sistema 'PLantillas'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol7->syncPermissions([2,3,4,5,6]);

        $rol8 = Spatie\Permission\Models\Role::create([
			'nom'				=> "Administrador de sistema 'Enviar notificación'",
            'name'              => 'adminDeSistemaEnviarNotificacion',
            'desc'              => "Acceso a todo el módulo de Sistema 'Enviar notificación'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol8->syncPermissions([7]);

        $rol9 = Spatie\Permission\Models\Role::create([
			'nom'				=> "Administrador de sistema 'Registro de actividades'",
            'name'              => 'adminDeSistemaRegistroDeActividades',
            'desc'              => "Acceso a todo el módulo de Sistema 'Registro de actividades'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol9->syncPermissions([8]);

        $rol10 = Spatie\Permission\Models\Role::create([
			'nom'				=> "Administrador de sistema 'Catálogos'",
            'name'              => 'adminDeSistemaCatalogos',
            'desc'              => "Acceso a todo el módulo de Sistema 'Catálogos'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol10->syncPermissions([9,10,11,12,13]);

        $rol11 = Spatie\Permission\Models\Role::create([
			'nom'				=> "Administrador de sistema 'Series'",
            'name'              => 'adminDeSistemaSeries',
            'desc'              => "Acceso a todo el módulo de Sistema 'Series'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'    => 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol11->syncPermissions([14,15,16,17,18]);

        $rol12 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de quejas y sugerencias',
            'name'				=> 'adminDeQuejasYSugerencias',
            'desc'              => "Acceso a todo el módulo de 'Quejas y sugerencias'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol12->syncPermissions([19,20,21]);

        $rol13 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de usuarios',
            'name'				=> 'adminDeDsuarios',
            'desc'              => "Acceso a todo el módulo de 'Usuarios'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol13->syncPermissions([22,23,24,25,26]);

        $rol14 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de clientes',
            'name'				=> 'adminDeClientes',
            'desc'              => "Acceso a todo el módulo de 'Clientes'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol14->syncPermissions([27,28,29,30,31]);

        $rol15 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de roles',
            'name'				=> 'adminDeRoles',
            'desc'              => "Acceso a todo el módulo de 'Roles'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol15->syncPermissions([32,33,34,35,36,37]);

        $rol16 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de papelera de reciclaje',
            'name'				=> 'adminDePapeleraDeReciclaje',
            'desc'              => "Acceso a todo el módulo de 'Papelera de reciclaje'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol16->syncPermissions([38,39,40]);

// MÓDULOS
        $rol18 = Spatie\Permission\Models\Role::create([
            'nom'				=> 'Administrador de pagos',
            'name'				=> 'adminDePagos',
            'desc'              => "Acceso a todo el módulo de 'Pagos'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
            'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol18->syncPermissions([]);

        $rol18 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de cotizaciones',
            'name'				=> 'adminDeCotizaciones',
            'desc'              => "Acceso a todo el módulo de 'Cotizaciones'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol18->syncPermissions([]);

        $rol19 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de proveedores',
            'name'				=> 'adminDeProveedores',
            'desc'              => "Acceso a todo el módulo de 'Proveedores'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol19->syncPermissions([]);

        $rol20 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de armados',
            'name'				=> 'adminDeArmados',
            'desc'              => "Acceso a todo el módulo de 'Armados'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol20->syncPermissions([]);

        $rol21 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de ventas',
            'name'				=> 'adminDeVentas',
            'desc'              => "Acceso a todo el módulo de 'Ventas'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol21->syncPermissions([]);

        $rol22 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de almacén',
            'name'				=> 'adminDeAlmacen',
            'desc'              => "Acceso a todo el módulo de 'Almacén'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol22->syncPermissions([]);

        $rol23 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de producción',
            'name'				=> 'adminDeProduccion',
            'desc'              => "Acceso a todo el módulo de 'Producción'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol23->syncPermissions([]);

        $rol24 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de logística',
            'name'				=> 'adminDeLogistica',
            'desc'              => "Acceso a todo el módulo de 'Logística'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol24->syncPermissions([]);

        $rol25 = Spatie\Permission\Models\Role::create([
			'nom'				=> 'Administrador de facturación',
            'name'				=> 'adminDeFacturacion',
            'desc'              => "Acceso a todo el módulo de 'Facturación'",
            'asignado_rol'      => 'desarrolloweb.ewmx@gmail.com',
        	'created_at_rol'	=> 'desarrolloweb.ewmx@gmail.com',
        ]);
        $rol25->syncPermissions([]);
    }
}

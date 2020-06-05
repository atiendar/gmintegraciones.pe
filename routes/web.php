<?php
Route::group(['middleware' => ['navegador', 'headerSeguro']], function() {
  require_once __DIR__ . '/public/authRoutes.php';

  Route::get('/offline', function() {
    return view('vendor.laravelpwa.offline');
  });
  
  Route::group(['middleware' => ['sinAccesoAlSistema', 'auth', 'idiomaSistema', 'primerAcceso']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::group(['middleware' => ['rolCliente']], function() {
      Route::get('prueba', function() {
        return 'exito';
      });
    });
 
    require_once __DIR__ . '/layouts/layoutsRoutes.php';
    require_once __DIR__ . '/usuario/usuarioRoutes.php';
    require_once __DIR__ . '/quejasYSugerencias/quejasYSugerenciasRoutes.php';
    require_once __DIR__ . '/cliente/clienteRoutes.php';
    require_once __DIR__ . '/papeleraDeReciclaje/papeleraDeReciclajeRoutes.php';
    require_once __DIR__ . '/proveedor/proveedorRoutes.php';
    require_once __DIR__ . '/armado/armadoRoutes.php';
    require_once __DIR__ . '/pago/pagoRoutes.php';
    require_once __DIR__ . '/costoDeEnvio/costoDeEnvioRoutes.php';
    require_once __DIR__ . '/cotizacion/cotizacionRoutes.php';

    Route::group(['prefix' => 'rastrea'], function() {
      require_once __DIR__ . '/rastrea/rastreaPedidoRoutes.php';
    });
    
    Route::group(['prefix' => 'perfil'], function() {
      require_once __DIR__ . '/perfil/perfilRoutes.php';
      require_once __DIR__ . '/perfil/notificacionRoutes.php';
      require_once __DIR__ . '/perfil/archivoGeneradoRoutes.php';
      require_once __DIR__ . '/perfil/recordatorioRoutes.php';
    });

    Route::group(['prefix' => 'sistema'], function() {
      require_once __DIR__ . '/sistema/sistemaRoutes.php';
      require_once __DIR__ . '/sistema/plantillaRoutes.php';
      require_once __DIR__ . '/sistema/notificacionRoutes.php';
      require_once __DIR__ . '/sistema/actividadRoutes.php';
      require_once __DIR__ . '/sistema/catalogoRoutes.php';
      require_once __DIR__ . '/sistema/serieRoutes.php';
    });

    Route::group(['prefix' => 'rol'], function() {
      require_once __DIR__ . '/rol/rolRoutes.php';
      require_once __DIR__ . '/rol/permisoRoutes.php';
    });

    Route::group(['prefix' => 'venta'], function() {
      require_once __DIR__ . '/venta/ventaRoutes.php';
      require_once __DIR__ . '/venta/pedidoActivoRoutes.php';
      require_once __DIR__ . '/venta/pedidoTerminadoRoutes.php';
    });

    Route::group(['prefix' => 'almacen'], function() {
      require_once __DIR__ . '/almacen/almacenRoutes.php';
      require_once __DIR__ . '/almacen/pedidoActivoRoutes.php';
      require_once __DIR__ . '/almacen/pedidoTerminadoRoutes.php';
      require_once __DIR__ . '/almacen/productoRoutes.php';
    });
  });
});
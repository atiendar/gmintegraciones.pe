<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'local'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionLocal\DireccionLocalController@index')->name('logistica.direccionLocal.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@show')->name('logistica.direccionLocal.show')->middleware('permission:logistica.direccionLocal.show');

  Route::group(['prefix' => 'comprobante'], function() {
    Route::group(['prefix' => 'salida'], function() {
      Route::match(['GET', 'HEAD'],'registrar/{id_direccion}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@create')->name('logistica.direccionLocal.comprobante.create')->middleware('permission:logistica.direccionLocal.create');
      Route::post('almacenar/{id_direccion}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@store')->name('logistica.direccionLocal.comprobante.store')->middleware('permission:logistica.direccionLocal.create');
      Route::match(['GET', 'HEAD'],'detalles/{id_comprobante}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@show')->name('logistica.direccionLocal.comprobante.show')->middleware('permission:logistica.direccionLocal.comprobante.show');
      Route::match(['GET', 'HEAD'],'editar/{id_comprobante}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@edit')->name('logistica.direccionLocal.comprobante.edit')->middleware('permission:');
      Route::post('actualizar/{id_comprobante}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@update')->name('logistica.direccionLocal.comprobante.update')->middleware('permission:');
    
      Route::group(['prefix' => 'entrega'], function() {
        Route::match(['GET', 'HEAD'],'registrar/{id_comprobante}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@createEntrega')->name('logistica.direccionLocal.comprobante.createEntrega')->middleware('permission:logistica.direccionLocal.comprobante.create');
        Route::post('almacenar/{id_comprobante}', 'Logistica\DireccionLocal\Comprobante\ComprobanteController@storeEntrega')->name('logistica.direccionLocal.comprobante.storeEntrega')->middleware('permission:logistica.direccionLocal.comprobante.create');
      });
    });
  });
});
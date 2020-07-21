<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'local'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionLocal\DireccionLocalController@index')->name('logistica.direccionLocal.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@show')->name('logistica.direccionLocal.show')->middleware('permission:logistica.direccionLocal.show');

  Route::group(['prefix' => 'comprobante-de-salida'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_direccion}', 'Logistica\DireccionLocal\ComprobanteDeSalida\ComprobanteDeSalidaController@create')->name('logistica.direccionLocal.comprobanteDeSalida.create')->middleware('permission:logistica.direccionLocal.create');
    Route::post('almacenar/{id_direccion}', 'Logistica\DireccionLocal\ComprobanteDeSalida\ComprobanteDeSalidaController@store')->name('logistica.direccionLocal.comprobanteDeSalida.store')->middleware('permission:logistica.direccionLocal.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_comprobante}', 'Logistica\DireccionLocal\ComprobanteDeSalida\ComprobanteDeSalidaController@show')->name('logistica.direccionLocal.comprobanteDeSalida.show')->middleware('permission:logistica.direccionLocal.comprobanteDeSalida.show');
    Route::match(['GET', 'HEAD'],'editar/{id_comprobante}', 'Logistica\DireccionLocal\ComprobanteDeSalida\ComprobanteDeSalidaController@edit')->name('logistica.direccionLocal.comprobanteDeSalida.edit')->middleware('permission:');
    Route::post('actualizar/{id_comprobante}', 'Logistica\DireccionLocal\ComprobanteDeSalida\ComprobanteDeSalidaController@update')->name('logistica.direccionLocal.comprobanteDeSalida.update')->middleware('permission:');
  });

  Route::group(['prefix' => 'comprobante-de-entrega'], function() {
    Route::match(['GET', 'HEAD'],'{id_direccion}', 'Logistica\DireccionLocal\ComprobanteDeEntrega\ComprobanteDeEntregaController@index')->name('logistica.direccionLocal.comprobanteEntrega.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.edit');
    Route::match(['GET', 'HEAD'],'registrar/{id_comprobante}', 'Logistica\DireccionLocal\ComprobanteDeEntrega\ComprobanteDeEntregaController@create')->name('logistica.direccionLocal.comprobanteEntrega.create')->middleware('permission:logistica.direccionLocal.comprobanteEntrega.create');
    Route::post('almacenar/{id_comprobante}', 'Logistica\DireccionLocal\ComprobanteDeEntrega\ComprobanteDeEntregaController@store')->name('logistica.direccionLocal.comprobanteEntrega.store')->middleware('permission:logistica.direccionLocal.comprobanteEntrega.create');
  });
});
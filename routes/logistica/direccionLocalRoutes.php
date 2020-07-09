<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'direccion-local'], function() {

  Route::match(['GET', 'HEAD'],'metodo-de-entrega-espescifico/{id_metodo_de_entrega}', 'Logistica\DireccionLocal\DireccionLocalController@metodoDeEntregaEspecifico')->name('logistica.metodoDeEntregaEspecifico.index')->middleware('permission:logistica.direccionLocal.createComprobantes');

  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionLocal\DireccionLocalController@index')->name('logistica.direccionLocal.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@show')->name('logistica.direccionLocal.show')->middleware('permission:logistica.direccionLocal.show');
  Route::match(['GET', 'HEAD'],'registrar-comprobante-de-salida/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@createComprobanteDeSalida')->name('logistica.direccionLocal.createComprobanteDeSalida')->middleware('permission:logistica.direccionLocal.createComprobantes');
  Route::post('almacenar-comprobante-de-salida/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@storeComprobanteDeSalida')->name('logistica.direccionLocal.storeComprobanteDeSalida')->middleware('permission:logistica.direccionLocal.createComprobantes');

  Route::match(['GET', 'HEAD'],'registrar-comprobante-de-entrega/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@createComprobanteDeEntrega')->name('logistica.direccionLocal.createComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.createComprobantes');
  Route::post('almacenar-comprobante-de-entrega/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@storeComprobanteDeEntrega')->name('logistica.direccionLocal.storeComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.createComprobantes');
});
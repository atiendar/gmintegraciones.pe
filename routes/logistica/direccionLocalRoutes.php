<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'direccion-local'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionLocal\DireccionLocalController@index')->name('logistica.direccionLocal.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Logistica\DireccionLocal\DireccionLocalController@show')->name('logistica.direccionLocal.show')->middleware('permission:logistica.direccionLocal.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Logistica\DireccionLocal\DireccionLocalController@edit')->name('logistica.direccionLocal.edit')->middleware('permission:logistica.direccionLocal.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Logistica\DireccionLocal\DireccionLocalController@update')->name('logistica.direccionLocal.update')->middleware('permission:logistica.direccionLocal.edit');
});
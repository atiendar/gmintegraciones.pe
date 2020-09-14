<?php
/* ===================== [ RUTAS LOGÍSTICA (DIRECCIÓN ENTREGADA) ] ===================== */
Route::group(['prefix' => 'direccion-entregada'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionEntregada\DireccionEntregadaController@index')->name('logistica.direccionEntregada.index')->middleware('permission:logistica.pedidoEntregado.index|logistica.pedidoEntregado.show');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionEntregada\DireccionEntregadaController@show')->name('logistica.direccionEntregada.show')->middleware('permission:logistica.pedidoEntregado.show');
});
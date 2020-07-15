<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'direccion-foraneo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionForaneo\DireccionForaneoController@index')->name('logistica.direccionForaneo.index')->middleware('permission:logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.edit');


  Route::group(['prefix' => 'comprobante'], function() {
    Route::match(['GET', 'HEAD'],'registrar-comprobante-de-entrega/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@createComprobanteDeEntrega')->name('logistica.direccionLocal.createComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.createComprobantes');
    Route::post('almacenar-comprobante-de-entrega/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@storeComprobanteDeEntrega')->name('logistica.direccionLocal.storeComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.createComprobantes');
    Route::match(['GET', 'HEAD'],'orden-de-produccion/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@generarComprobanteDeEntrega')->name('logistica.direccionLocal.generarComprobanteDeEntrega')->middleware('permission:produccion.pedidoActivo.index');
  
  });


});
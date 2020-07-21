<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'foraneo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionForaneo\DireccionForaneoController@index')->name('logistica.direccionForaneo.index')->middleware('permission:logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.edit');


  Route::group(['prefix' => 'comprobante-de-salida'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_direccion}', 'Logistica\DireccionForaneo\ComprobanteDeSalida\ComprobanteDeSalidaController@create')->name('logistica.direccionForaneo.comprobanteDeSalida.create')->middleware('permission:logistica.direccionForaneo.create');
  });

  Route::group(['prefix' => 'comprobante-de-entrega'], function() {
    Route::match(['GET', 'HEAD'],'{id_direccion}', 'Logistica\DireccionForaneo\ComprobanteDeEntrega\ComprobanteDeEntregaController@index')->name('logistica.direccionForaneo.comprobanteEntrega.index')->middleware('permission:logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.edit');
  });
});
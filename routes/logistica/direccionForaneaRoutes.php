<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS FORANEOS) ] ===================== */
Route::group(['prefix' => 'foraneo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionForaneo\DireccionForaneoController@index')->name('logistica.direccionForaneo.index')->middleware('permission:logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.create|logistica.direccionForaneo.createEntrega');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionForaneo\DireccionForaneoController@show')->name('logistica.direccionForaneo.show')->middleware('permission:logistica.direccionForaneo.show');
  Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'Logistica\DireccionForaneo\DireccionForaneoController@edit')->name('logistica.direccionForaneo.edit')->middleware('permission:logistica.direccionForaneo.edit');
  Route::group(['prefix' => 'comprobante-de-salida'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_direccion}', 'Logistica\DireccionForaneo\DireccionForaneoController@create')->name('logistica.direccionForaneo.create')->middleware('permission:logistica.direccionForaneo.create');
  });

  Route::group(['prefix' => 'comprobante-de-entrega'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_comprobante}', 'Logistica\DireccionForaneo\DireccionForaneoController@createEntrega')->name('logistica.direccionForaneo.createEntrega')->middleware('permission:logistica.direccionForaneo.createEntrega|logistica.direccionLocFor.createEntrega');
  });
});
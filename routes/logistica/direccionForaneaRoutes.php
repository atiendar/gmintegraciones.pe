<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'direccion-foraneo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionForaneo\DireccionForaneoController@index')->name('logistica.direccionForaneo.index')->middleware('permission:logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.edit');
});
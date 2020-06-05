<?php
/* ===================== [ RUTAS (COSTOS DE ENVÍO) ] ===================== */
Route::group(['prefix' => 'costo-de-envio'], function() {
  Route::match(['GET', 'HEAD'],'obtener', 'CostoDeEnvio\CostoDeEnvioController@obtener')->name('costoDeEnvio.obtener')->middleware('permission:cotizacion.edit');
});
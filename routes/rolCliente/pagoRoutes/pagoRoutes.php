<?php
/* ===================== [ RUTAS (PAGOS) ] ===================== */
Route::group(['prefix' => 'pago'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Pago\PagoController@index')->name('rolCliente.pago.index');
  Route::match(['GET', 'HEAD'],'crear', 'RolCliente\Pago\PagoController@create')->name('rolCliente.pago.create');
  Route::post('registrar', 'RolCliente\Pago\PagoController@store')->name('rolCliente.direccpagoion.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_pago}', 'RolCliente\Pago\PagoController@show')->name('rolCliente.pago.show');
});
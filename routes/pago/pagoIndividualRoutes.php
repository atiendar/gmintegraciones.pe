<?php
/* ===================== [ RUTAS PAGOS (INDIVIDUAL) ] ===================== */
Route::group(['prefix' => 'individual'], function() {
  Route::match(['GET', 'HEAD'],'', 'Pago\Individual\PagoController@index')->name('pago.index')->middleware('permission:pago.index');
  Route::post('almacenar/{id_pedido}', 'Pago\Individual\PagoController@store')->name('pago.store')->middleware('permission:pago.create');
  Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\Individual\PagoController@show')->name('pago.show')->middleware('permission:pago.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\Individual\PagoController@edit')->name('pago.edit')->middleware('permission:pago.edit');
  
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'Pago\Individual\PagoController@update')->name('pago.update')->middleware('permission:pago.edit');
  Route::match(['DELETE'],'eliminar/{id_pago}', 'Pago\Individual\PagoController@destroy')->name('pago.destroy')->middleware('permission:pago.destroy');
  });
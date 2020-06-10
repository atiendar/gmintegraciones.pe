<?php
/* ===================== [ RUTAS PAGOS (FILTRADO POR PEDIDO) ] ===================== */
Route::group(['prefix' => 'f-pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'Pago\fPedido\PagoPedidoController@index')->name('pago.fPedido.index')->middleware('permission:pago.fPedido.index|pago.fPedido.create|pago.fPedido.show|pago.fPedido.edit');
  Route::match(['GET', 'HEAD'],'registrar/{id_pedido}', 'Pago\fPedido\PagoPedidoController@create')->name('pago.fPedido.create')->middleware('permission:pago.fPedido.index|pago.fPedido.create|pago.fPedido.show|pago.fPedido.edit');
  Route::post('almacenar/{id_pedido}', 'Pago\Individual\PagoController@store')->name('pago.fPedido.store')->middleware('permission:pago.fPedido.create');
  Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\fPedido\PagoPedidoController@show')->name('pago.fPedido.show')->middleware('permission:pago.fPedido.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\fPedido\PagoPedidoController@edit')->name('pago.fPedido.edit')->middleware('permission:pago.fPedido.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'Pago\fPedido\PagoPedidoController@update')->name('pago.fPedido.update')->middleware('permission:pago.fPedido.edit');
});
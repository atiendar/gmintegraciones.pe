<?php
/* ===================== [ RUTAS PAGOS (FILTRADO POR PEDIDO) ] ===================== */
Route::group(['prefix' => 'f-pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'Pago\fPedido\PagoPedidoController@index')->name('pago.fPedido.index')->middleware('permission:pago.index');
  Route::match(['GET', 'HEAD'],'registrar/{id_pedido}', 'Pago\fPedido\PagoPedidoController@create')->name('pago.fPedido.create')->middleware('permission:pago.edit');
  Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\fPedido\PagoPedidoController@show')->name('pago.fPedido.show')->middleware('permission:pago.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\fPedido\PagoPedidoController@edit')->name('pago.fPedido.edit')->middleware('permission:pago.edit');
});
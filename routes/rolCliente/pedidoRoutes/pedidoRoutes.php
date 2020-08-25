<?php
/* ===================== [ RUTAS (PEDIDOS) ] ===================== */
Route::group(['prefix' => 'pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Pedido\PedidoController@index')->name('rolCliente.pedido.index');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'RolCliente\Pedido\PedidoController@show')->name('rolCliente.pedido.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'RolCliente\Pedido\PedidoController@edit')->name('rolCliente.pedido.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'RolCliente\Pedido\PedidoController@update')->name('rolCliente.pedido.update');
});
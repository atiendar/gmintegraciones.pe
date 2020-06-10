<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS ACTIVOS) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Venta\PedidoActivo\PedidoActivoController@index')->name('venta.pedidoActivo.index')->middleware('permission:venta.pedidoActivo.index|venta.pedidoActivo.create|venta.pedidoActivo.show|venta.pedidoActivo.edit|venta.pedidoActivo.destroy');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@show')->name('venta.pedidoActivo.show')->middleware('permission:venta.pedidoActivo.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@edit')->name('venta.pedidoActivo.edit')->middleware('permission:venta.pedidoActivo.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@update')->name('venta.pedidoActivo.update')->middleware('permission:venta.pedidoActivo.edit');
  Route::match(['DELETE'],'eliminar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@destroy')->name('venta.pedidoActivo.destroy')->middleware('permission:venta.pedidoActivo.destroy');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('venta.pedidoActivo.armado.show')->middleware('permission:venta.pedidoActivo.armado.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('venta.pedidoActivo.armado.edit')->middleware('permission:venta.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('venta.pedidoActivo.armado.update')->middleware('permission:venta.pedidoActivo.armado.edit');
  });
});
<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
  Route::match(['GET', 'HEAD'],'', 'Venta\PedidoTerminado\PedidoTerminadoController@index')->name('venta.pedidoTerminado.index')->middleware('permission:venta.pedidoTerminado.index|venta.pedidoTerminado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Venta\PedidoTerminado\PedidoTerminadoController@show')->name('venta.pedidoTerminado.show')->middleware('permission:venta.pedidoTerminado.show');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Venta\PedidoTerminado\ArmadoPedidoTerminado\ArmadoPedidoTerminadoController@show')->name('venta.pedidoTerminado.armado.show')->middleware('permission:venta.pedidoTerminado.show');
  });
});
<?php
/* ===================== [ RUTAS LOGÍSTICA (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\PedidoTerminado\PedidoTerminadoController@index')->name('logistica.pedidoTerminado.index')->middleware('permission:logistica.pedidoTerminado.index|logistica.pedidoTerminado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Logistica\PedidoTerminado\PedidoTerminadoController@show')->name('logistica.pedidoTerminado.show')->middleware('permission:logistica.pedidoTerminado.show');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Logistica\PedidoTerminado\ArmadoPedidoTerminado\ArmadoPedidoTerminadoController@show')->name('logistica.pedidoTerminado.armado.show')->middleware('permission:logistica.pedidoTerminado.show');
  });
});
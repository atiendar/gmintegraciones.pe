<?php
/* ===================== [ RUTAS LOGÍSTICA (PEDIDO ACTIVO LOCAL) ] ===================== */
Route::group(['prefix' => 'pedido-activo/local'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\PedidoActivoLocal\PedidoActivoController@index')->name('logistica.pedidoActivoLocal.index')->middleware('permission:logistica.pedidoActivoLocal.index|logistica.pedidoActivoLocal.show|logistica.pedidoActivoLocal.edit|logistica.pedidoActivoLocal.armado.show|logistica.pedidoActivoLocal.armado.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Logistica\PedidoActivoLocal\PedidoActivoController@show')->name('logistica.pedidoActivoLocal.show')->middleware('permission:logistica.pedidoActivoLocal.show|logistica.pedidoActivoLocal.armado.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Logistica\PedidoActivoLocal\PedidoActivoController@edit')->name('logistica.pedidoActivoLocal.edit')->middleware('permission:logistica.pedidoActivoLocal.edit|logistica.pedidoActivoLocal.armado.show|logistica.pedidoActivoLocal.armado.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Logistica\PedidoActivoLocal\PedidoActivoController@update')->name('logistica.pedidoActivoLocal.update')->middleware('permission:logistica.pedidoActivoLocal.edit');
  Route::match(['GET', 'HEAD'],'orden-de-logistica/{id_pedido}', 'Logistica\PedidoActivoLocal\PedidoActivoController@generarOrdenDeLogistica')->name('logistica.pedidoActivoLocal.generarOrdenDeLogistica')->middleware('permission:logistica.pedidoActivoLocal.index');
 
  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Logistica\PedidoActivoLocal\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('logistica.pedidoActivoLocal.armado.show')->middleware('permission:logistica.pedidoActivoLocal.armado.show|logistica.pedidoActivoLocal.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Logistica\PedidoActivoLocal\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('logistica.pedidoActivoLocal.armado.edit')->middleware('permission:logistica.pedidoActivoLocal.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Logistica\PedidoActivoLocal\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('logistica.pedidoActivoLocal.armado.update')->middleware('permission:logistica.pedidoActivoLocal.armado.edit');
  });
});
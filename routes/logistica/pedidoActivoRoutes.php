<?php
/* ===================== [ RUTAS LOGÍSTICA (PEDIDO ACTIVO) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\PedidoActivo\PedidoActivoController@index')->name('logistica.pedidoActivo.index')->middleware('permission:logistica.pedidoActivo.index|logistica.pedidoActivo.show|logistica.pedidoActivo.edit|logistica.pedidoActivo.armado.show|logistica.pedidoActivo.armado.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Logistica\pedidoActivo\PedidoActivoController@show')->name('logistica.pedidoActivo.show')->middleware('permission:logistica.pedidoActivo.show|logistica.pedidoActivo.armado.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Logistica\PedidoActivo\PedidoActivoController@edit')->name('logistica.pedidoActivo.edit')->middleware('permission:logistica.pedidoActivo.edit|logistica.pedidoActivo.armado.show|logistica.pedidoActivo.armado.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Logistica\PedidoActivo\PedidoActivoController@update')->name('logistica.pedidoActivo.update')->middleware('permission:logistica.pedidoActivo.edit');
  
  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('logistica.pedidoActivo.armado.show')->middleware('permission:logistica.pedidoActivo.armado.show|logistica.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('logistica.pedidoActivo.armado.edit')->middleware('permission:logistica.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('logistica.pedidoActivo.armado.update')->middleware('permission:logistica.pedidoActivo.armado.edit');
  });

  Route::group(['prefix' => 'direccion'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@show')->name('logistica.pedidoActivo.armado.direccion.show')->middleware('permission:logistica.pedidoActivo.armado.show');
    Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@edit')->name('logistica.pedidoActivo.armado.direccion.edit')->middleware('permission:logistica.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_direccion}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@update')->name('logistica.pedidoActivo.armado.direccion.update')->middleware('permission:logistica.pedidoActivo.armado.edit');
    Route::match(['GET', 'HEAD'],'comprobante-de-entrega/{id_direccion}', 'Logistica\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@generarComprobanteDeEntrega')->name('logistica.pedidoActivo.armado.direccion.generarComprobanteDeEntrega')->middleware('permission:logistica.pedidoActivo.armado.edit');
  });
});
<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS ACTIVOS) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'{opc_consulta?}', 'Venta\PedidoActivo\PedidoActivoController@index')->name('venta.pedidoActivo.index')->middleware('permission:venta.pedidoActivo.index|venta.pedidoActivo.show|venta.pedidoActivo.edit|venta.pedidoActivo.destroy|venta.pedidoActivo.armado.show|venta.pedidoActivo.armado.edit|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.show|venta.pedidoActivo.pago.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@show')->name('venta.pedidoActivo.show')->middleware('permission:venta.pedidoActivo.show|venta.pedidoActivo.armado.show|venta.pedidoActivo.pago.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@edit')->name('venta.pedidoActivo.edit')->middleware('permission:venta.pedidoActivo.edit|venta.pedidoActivo.armado.edit|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@update')->name('venta.pedidoActivo.update')->middleware('permission:venta.pedidoActivo.edit');
  Route::match(['DELETE'],'eliminar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@destroy')->name('venta.pedidoActivo.destroy')->middleware('permission:venta.pedidoActivo.destroy');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('venta.pedidoActivo.armado.show')->middleware('permission:venta.pedidoActivo.armado.show|venta.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('venta.pedidoActivo.armado.edit')->middleware('permission:venta.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('venta.pedidoActivo.armado.update')->middleware('permission:venta.pedidoActivo.armado.edit');

    Route::group(['prefix' => 'direccion'], function() {
      Route::post('almacenar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@store')->name('venta.pedidoActivo.armado.direccion.store')->middleware('permission:venta.pedidoActivo.armado.edit');
      Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Venta\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@show')->name('venta.pedidoActivo.armado.direccion.show')->middleware('permission:venta.pedidoActivo.armado.show');
      Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'Venta\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@edit')->name('venta.pedidoActivo.armado.direccion.edit')->middleware('permission:venta.pedidoActivo.armado.edit');
      Route::match(['PUT', 'PATCH'],'actualizar/{id_direccion}', 'Venta\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@update')->name('venta.pedidoActivo.armado.direccion.update')->middleware('permission:venta.pedidoActivo.armado.edit');
    });
  });
});
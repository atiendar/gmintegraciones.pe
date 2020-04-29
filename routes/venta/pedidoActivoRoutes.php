<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS ACTIVOS) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
    Route::match(['GET', 'HEAD'],'', 'Venta\PedidoActivo\PedidoActivoController@index')->name('venta.pedidoActivo.index')->middleware('permission:venta.pedidoActivo.index|venta.pedidoActivo.create|venta.pedidoActivo.show|venta.pedidoActivo.edit|venta.pedidoActivo.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Venta\PedidoActivo\PedidoActivoController@create')->name('venta.pedidoActivo.create')->middleware('permission:venta.pedidoActivo.create');
    Route::post('almacenar', 'Venta\PedidoActivo\PedidoActivoController@store')->name('venta.pedidoActivo.store')->middleware('permission:venta.pedidoActivo.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@show')->name('venta.pedidoActivo.show')->middleware('permission:venta.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@edit')->name('venta.pedidoActivo.edit')->middleware('permission:venta.pedidoActivo.edit');
    
    Route::group(['prefix' => 'actualizar'], function() {
        Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@update')->name('venta.pedidoActivo.update')->middleware('permission:venta.pedidoActivo.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/total-de-armados/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@updateTotalDeArmados')->name('venta.pedidoActivo.updateTotalDeArmados')->middleware('permission:venta.pedidoActivo.updateTotalDeArmados');
        Route::match(['PUT', 'PATCH'],'actualizar/monto-total/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@updateMontoTotal')->name('venta.pedidoActivo.updateMontoTotal')->middleware('permission:venta.pedidoActivo.updateMontoTotal');
    }); 
    Route::match(['DELETE'],'eliminar/{id_pedido}', 'Venta\PedidoActivo\PedidoActivoController@destroy')->name('venta.pedidoActivo.destroy')->middleware('permission:venta.pedidoActivo.destroy');

    Route::group(['prefix' => 'armado'], function() {
        Route::match(['GET', 'HEAD'],'', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@index')->name('venta.pedidoActivo.armado.index')->middleware('permission:venta.pedidoActivo.armado.index|venta.pedidoActivo.armado.create|venta.pedidoActivo.armado.show|venta.pedidoActivo.armado.edit|venta.pedidoActivo.armado.destroy');
        Route::match(['GET', 'HEAD'],'crear/{id_pedido}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@create')->name('venta.pedidoActivo.armado.create')->middleware('permission:venta.pedidoActivo.armado.create');
        Route::post('almacenar/{id_pedido}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@store')->name('venta.pedidoActivo.armado.store')->middleware('permission:venta.pedidoActivo.armado.create');
        Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('venta.pedidoActivo.armado.show')->middleware('permission:venta.pedidoActivo.armado.show');
        Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('venta.pedidoActivo.armado.edit')->middleware('permission:venta.pedidoActivo.armado.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('venta.pedidoActivo.armado.update')->middleware('permission:venta.pedidoActivo.armado.edit');
        Route::match(['DELETE'],'eliminar/{id_armado}', 'Venta\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@destroy')->name('venta.pedidoActivo.armado.destroy')->middleware('permission:venta.pedidoActivo.armado.destroy');
    });

    Route::group(['prefix' => 'pago'], function() {
        Route::match(['GET', 'HEAD'],'crear/{id_pedido}', 'Venta\PedidoActivo\PagoPedidoActivo\PagoPedidoActivoController@create')->name('venta.pedidoActivo.pago.create')->middleware('permission:venta.pedidoActivo.pago.create');
        Route::match(['GET', 'HEAD'],'detalles/{id_pago}', 'Venta\PedidoActivo\PagoPedidoActivo\PagoPedidoActivoController@show')->name('venta.pedidoActivo.pago.show')->middleware('permission:venta.pedidoActivo.pago.show');
        Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Venta\PedidoActivo\PagoPedidoActivo\PagoPedidoActivoController@edit')->name('venta.pedidoActivo.pago.edit')->middleware('permission:venta.pedidoActivo.pago.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'Venta\PedidoActivo\PagoPedidoActivo\PagoPedidoActivoController@update')->name('venta.pedidoActivo.pago.update')->middleware('permission:venta.pedidoActivo.pago.edit');
    });
});
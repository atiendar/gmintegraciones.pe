<?php
/* ===================== [ RUTAS ALMACÉN (PEDIDO ACTIVO) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
    Route::match(['GET', 'HEAD'],'', 'Almacen\PedidoActivo\PedidoActivoController@index')->name('almacen.pedidoActivo.index')->middleware('permission:almacen.pedidoActivo.index|almacen.pedidoActivo.show|almacen.pedidoActivo.edit|almacen.pedidoActivo.pdf|almacen.pedidoActivo.armadoPedidoActivo.show|almacen.pedidoActivo.armadoPedidoActivo.edit');
    Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@show')->name('almacen.pedidoActivo.show')->middleware('permission:almacen.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@edit')->name('almacen.pedidoActivo.edit')->middleware('permission:almacen.pedidoActivo.edit|almacen.pedidoActivo.armadoPedidoActivo.show|almacen.pedidoActivo.armadoPedidoActivo.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@update')->name('almacen.pedidoActivo.update')->middleware('permission:almacen.pedidoActivo.edit');
    Route::match(['GET', 'HEAD'],'orden-de-produccion-almacen/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@pdf')->name('almacen.pedidoActivo.pdf')->middleware('permission:almacen.pedidoActivo.pdf');

    Route::group(['prefix' => 'armado'], function() {
        Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Almacen\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('almacen.pedidoActivo.armadoPedidoActivo.show')->middleware('permission:almacen.pedidoActivo.armadoPedidoActivo.show');
        Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Almacen\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('almacen.pedidoActivo.armadoPedidoActivo.edit')->middleware('permission:almacen.pedidoActivo.armadoPedidoActivo.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Almacen\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('almacen.pedidoActivo.armadoPedidoActivo.update')->middleware('permission:almacen.pedidoActivo.armadoPedidoActivo.edit');
    });
});
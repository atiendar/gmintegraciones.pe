<?php
/* ===================== [ RUTAS (PAGOS) ] ===================== */
Route::group(['prefix' => 'pago'], function() {
    Route::match(['GET', 'HEAD'],'', 'Pago\PagoController@index')->name('pago.index')->middleware('permission:pago.index');
    Route::post('almacenar/{id_pedido}', 'Pago\PagoController@store')->name('pago.store')->middleware('permission:pago.create');
    Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\PagoController@show')->name('pago.show')->middleware('permission:pago.show');
    Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\PagoController@edit')->name('pago.edit')->middleware('permission:pago.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'Pago\PagoController@update')->name('pago.update')->middleware('permission:pago.edit');
    Route::match(['DELETE'],'eliminar/{id_pago}', 'Pago\PagoController@destroy')->name('pago.destroy')->middleware('permission:pago.destroy');

    Route::group(['prefix' => 'f-pedido'], function() {
        Route::match(['GET', 'HEAD'],'', 'Pago\PagoPedidoController@index')->name('pago.fPedido.index')->middleware('permission:pago.index');
        Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\PagoPedidoController@edit')->name('pago.fPedido.edit')->middleware('permission:pago.edit');
        Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\PagoPedidoController@show')->name('pago.fPedido.show')->middleware('permission:pago.show');
        Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\PagoPedidoController@edit')->name('pago.fPedido.edit')->middleware('permission:pago.edit');
        Route::match(['DELETE'],'eliminar/{id_pago}', 'Pago\PagoPedidoController@destroy')->name('pago.fPedido.destroy')->middleware('permission:pago.destroy');
    });
});
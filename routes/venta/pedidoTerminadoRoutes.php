<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
    Route::match(['GET', 'HEAD'],'', 'Venta\PedidoTerminado\PedidoTerminadoController@index')->name('venta.pedidoTerminado.index')->middleware('permission:venta.pedidoTerminado.index');
});
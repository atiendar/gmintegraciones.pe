<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
    Route::match(['GET', 'HEAD'],'', 'Almacen\PedidoTerminado\PedidoTerminadoController@index')->name('almacen.pedidoTerminado.index');
}); 
<?php
/* ===================== [ RUTAS VENTAS (RASTREAR PEDIDO) ] ===================== */
Route::group(['prefix' => 'rastrear-pedido'], function() {
    Route::match(['GET', 'HEAD'],'rastrear-pedido/{id_pedido}', 'Venta\RastrearPedido\RastrearPedidoController@rastrear')->name('venta.rastrearPedido.rastrear');
});
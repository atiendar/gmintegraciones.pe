<?php
/* ===================== [ RUTAS RASTREAR (RASTREAR PEDIDO) ] ===================== */
Route::group(['prefix' => 'pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'Rastrea\RastreaPedidoController@index')->name('rastrea.pedido.index')->middleware('permission:rastrea.pedido.show|rastrea.pedido.showFull');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Rastrea\RastreaPedidoController@show')->name('rastrea.pedido.show')->middleware('permission:rastrea.pedido.show|rastrea.pedido.showFull');
});
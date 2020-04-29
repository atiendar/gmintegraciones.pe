<?php
/* ===================== [ RUTAS (VENTAS) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Venta\VentaController@index')->name('venta.index')->middleware('permission:venta.index');
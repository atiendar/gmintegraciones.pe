<?php
/* ===================== [ RUTAS (PAGOS) ] ===================== */
Route::group(['prefix' => 'pago'], function() {
    Route::match(['GET', 'HEAD'],'', 'Pago\PagoController@index')->name('pago.index')->middleware('permission:pago.index');
});
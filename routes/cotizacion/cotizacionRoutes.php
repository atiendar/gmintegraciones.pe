<?php
/* ===================== [ RUTAS (COTIZACION) ] ===================== */
Route::group(['prefix' => 'cotizacion'], function() {
    Route::match(['GET', 'HEAD'],'', 'Cotizacion\CotizacionController@index')->name('cotizacion.index')->middleware('permission:cotizacion.index|cotizacion.create|cotizacion.show|cotizacion.edit|cotizacion.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Cotizacion\CotizacionController@create')->name('cotizacion.create')->middleware('permission:cotizacion.create');
    Route::post('almacenar', 'Cotizacion\CotizacionController@store')->name('cotizacion.store')->middleware('permission:cotizacion.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_cotizacion}', 'Cotizacion\CotizacionController@show')->name('cotizacion.show')->middleware('permission:cotizacion.show');
    Route::match(['GET', 'HEAD'],'editar/{id_cotizacion}', 'Cotizacion\CotizacionController@edit')->name('cotizacion.edit')->middleware('permission:cotizacion.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_cotizacion}', 'Cotizacion\CotizacionController@update')->name('cotizacion.update')->middleware('permission:cotizacion.edit');
    Route::match(['DELETE'],'eliminar/{id_cotizacion}', 'Cotizacion\CotizacionController@destroy')->name('cotizacion.destroy')->middleware('permission:cotizacion.destroy');

    Route::group(['prefix' => 'armado'], function() {
        Route::post('almacenar/{id_cotizacion}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@store')->name('cotizacion.armado.store')->middleware('permission:cotizacion.edit');
        Route::match(['GET', 'HEAD'],'editar/{id_producto}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@edit')->name('cotizacion.armado.edit')->middleware('permission:cotizacion.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/{id_producto}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@update')->name('cotizacion.armado.update')->middleware('permission:cotizacion.edit');
        Route::match(['DELETE'],'eliminar/{id_producto}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@destroy')->name('cotizacion.armado.destroy')->middleware('permission:cotizacion.edit');
        Route::match(['PUT', 'PATCH'],'actualizar-cantidad/{id_producto}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@editCantidad')->name('cotizacion.armado.editCantidad')->middleware('permission:cotizacion.edit');
        Route::match(['PUT', 'PATCH'],'actualizar-utilidad/{id_producto}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@editUtilidad')->name('cotizacion.armado.editUtilidad')->middleware('permission:cotizacion.edit');

    });
});
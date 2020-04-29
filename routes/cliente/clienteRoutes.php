<?php
/* ===================== [ RUTAS (CLIENTE) ] ===================== */
Route::group(['prefix' => 'cliente'], function() {
    Route::match(['GET', 'HEAD'],'', 'Cliente\ClienteController@index')->name('cliente.index')->middleware('permission:cliente.index|cliente.create|cliente.show|cliente.edit|cliente.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Cliente\ClienteController@create')->name('cliente.create')->middleware('permission:cliente.create');
    Route::post('almacenar', 'Cliente\ClienteController@store')->name('cliente.store')->middleware('permission:cliente.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_cliente}', 'Cliente\ClienteController@show')->name('cliente.show')->middleware('permission:cliente.show');
    Route::match(['GET', 'HEAD'],'editar/{id_cliente}', 'Cliente\ClienteController@edit')->name('cliente.edit')->middleware('permission:cliente.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_usuario}', 'Cliente\ClienteController@update')->name('cliente.update')->middleware('permission:cliente.edit');
    Route::match(['DELETE'],'eliminar/{id_cliente}', 'Cliente\ClienteController@destroy')->name('cliente.destroy')->middleware('permission:cliente.destroy');
    Route::match(['GET', 'HEAD'],'re-enviar-correo-bienvenida/{id_cliente}', 'Cliente\ClienteController@reEnviarCorreoBienvenida')->name('cliente.reEnviarCorreoBienvenida')->middleware('permission:cliente.create');
});
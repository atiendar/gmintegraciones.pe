<?php
/* ===================== [ RUTAS (SOPORTE) ] ===================== */
Route::group(['prefix' => 'soporte'], function() {
  Route::match(['GET', 'HEAD'],'', 'TecnologiaDeLaInformacion\SoporteController@index')->name('soporte.index');
  Route::match(['GET', 'HEAD'],'detalles/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@show')->name('soporte.show');
  Route::match(['GET', 'HEAD'],'editar/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@edit')->name('soporte.edit');
  Route::match(['PUT', 'PATCH'], 'actualizar/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@update')->name('soporte.update');
  Route::match(['DELETE'],'eliminar/{id_soporte}','TecnologiaDeLaInformacion\SoporteController@destroy')->name('soporte.destroy');
});
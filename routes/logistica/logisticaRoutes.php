<?php
/* ===================== [ RUTAS (LOGÍSTICA) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Logistica\LogisticaController@index')->name('logistica.index')->middleware('permission:logistica.pedidoActivo.index|logistica.pedidoActivo.show|logistica.pedidoActivo.edit|logistica.pedidoActivo.armado.show|logistica.pedidoActivo.armado.edit|logistica.pedidoTerminado.index|logistica.pedidoTerminado.show');
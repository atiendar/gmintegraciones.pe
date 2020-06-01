@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pedidos activos'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('almacen.pedido.alm_ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'almacen.pedidoActivo.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.pedidoActivo.index'), 'opciones_buscador' => config('opcionesSelect.select_almacen_pedido_activo_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_activo.alm_pedAct_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de direcciones'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.direccion.dir_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.direccion.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.direccion.index'), 'opciones_buscador' => config('opcionesSelect.select_direcciones_index')])
    {!! Form::close() !!}
    @include('rolCliente.direccion.dir_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones])
  </div>
</div>
@endsection
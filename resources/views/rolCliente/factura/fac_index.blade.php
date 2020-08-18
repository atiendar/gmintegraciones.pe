@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de facturas'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.factura.fac_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.factura.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.factura.index'), 'opciones_buscador' => config('opcionesSelect.select_facturas_index')])
    {!! Form::close() !!}
    @include('rolCliente.factura.fac_table')
    @include('global.paginador.paginador', ['paginar' => $facturas])
  </div>
</div>
@endsection
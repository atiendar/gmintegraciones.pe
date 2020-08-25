@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pedidos'))</title>
<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.pedido.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.pedido.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_pedido_index')])
    {!! Form::close() !!}
    @include('rolCliente.pedido.ped_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection
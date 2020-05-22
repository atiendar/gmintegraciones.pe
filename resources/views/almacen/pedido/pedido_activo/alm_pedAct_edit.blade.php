@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido almacén'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
    <div class="card-header p-1 border-botto tex">
      <h5>
        <strong>{{ __('Editar pedido almacén') }}: </strong>
        @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}">{{ $pedido->serie.'-'.$pedido->id }}</a>
     @else
     {{ $pedido->serie.'-'.$pedido->id }}
     @endcan
      </h5>
    </div>
    <div class="ribbon-wrapper">
      <div class="ribbon bg-info"> 
        <small>{{ $pedido->id }}</small>
      </div>
    </div>
  </div>
@can('almacen.pedidoActivo.edit')
    <div class="card card-info card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['almacen.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'pedidoActivoUpdate', 'files' => true]) !!}
        @include('almacen.pedido_activo.alm_pedAct_editFields')
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endcan
@include('almacen.pedido_activo.armado_activo.alm_pedAct_armAct_index')
@endsection
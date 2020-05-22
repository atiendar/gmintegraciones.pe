@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Datos generales del armado:'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Datos generales del armado') }}:</strong>
      @can('almacen.pedidoActivo.armadoPedidoActivo.edit')
       <a href="{{ route('almacen.pedidoActivo.armadoPedidoActivo.edit', Crypt::encrypt($armado->id)) }}">{{ $armado->id }}</a>
      @else
       {{ $armado->id }}
      @endcan
      <strong>{{ __('estas en el pedido') }}:</strong> {{ $armado->pedido->num_ped_unif }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('almacen.pedido_activo.armado_activo.alm_pedAct_armAct_showFields')
  </div>
</div>
@endsection
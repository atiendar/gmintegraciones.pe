@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles dirección') }}:</strong>
      @can('venta.pedidoActivo.armado.direccion.edit')
        <a href="{{ route('venta.pedidoActivo.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class="text-white">{{ $direccion->est }}</a>,
      @else
        {{ $direccion->est }},
      @endcan
     <strong>{{ __('del armado') }}:</strong> {{ $direccion->armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields')
  </div>
</div>
@endsection
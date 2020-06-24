@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar direccion').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar direccion') }}:</strong>
      @can('venta.pedidoActivo.armado.show')
        <a href="{{ route('venta.pedidoActivo.armado.show', Crypt::encrypt($direccion->id)) }}" class="text-white">{{ $direccion->est }}</a>,
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
    {!! Form::open(['route' => ['venta.pedidoActivo.armado.direcion.update', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoArmadoDirecionUpdate', 'files' => true]) !!}
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
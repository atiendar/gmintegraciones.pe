@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles armado').' '.$armado->cod)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles armado') }}:</strong>
      @can('venta.pedidoActivo.armado.edit')
        <a href="{{ route('venta.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}">{{ $armado->cod }}</a>,
      @else
        {{ $armado->cod }},
      @endcan
     <strong>{{ __('del pedido') }}:</strong> {{ $armado->pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $armado->cod }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_showFields')
  </div>
</div>
@include('venta.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.ven_pedAct_armPedAct_dirArmPedAct_index')
@endsection
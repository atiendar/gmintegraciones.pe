@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->fech_de_entreg) ? 'card-danger' : 'card-info' }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <div class="float-right mr-5">
      <strong>{{ __('Monto total del pedido') }}: </strong> @include('venta.pedido_activo.ven_pedAct_showFields.montoTotalDelPedido')
      | <strong>{{ __('Estatus ventas') }}: </strong> @include('venta.pedido_activo.ven_pedAct_showFields.estatusVentas')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong>
      @can('venta.pedidoActivo.edit')
        <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.ven_pedAct_showFields')
  </div>
</div>
@include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_index')
@include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_index')
@endsection
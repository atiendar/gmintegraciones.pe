@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido').' '.$pedido->num_pedido)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <div class="float-right mr-5">
      <strong>{{ __('Estatus ventas') }}: </strong> @include('venta.pedido_activo.ven_pedAct_showFields.estatusVentas')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong>
      @can('venta.pedidoActivo.show')
        <a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}">{{ $pedido->num_pedido }}</a>
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
</div>
@include('venta.pedido_activo.ven_pedAct_editOtrosFields')
@can('venta.pedidoActivo.edit')
  <div class="card card-info card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['venta.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoUpdate', 'files' => true]) !!}
        @include('venta.pedido_activo.ven_pedAct_editFields')
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_index')
@include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_index')
@endsection
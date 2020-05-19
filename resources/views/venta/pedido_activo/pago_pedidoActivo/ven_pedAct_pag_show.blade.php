@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pago').' '.$pago->id)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('venta.pedidoActivo.pago.edit')
        <a href="{{ route('venta.pedidoActivo.pago.edit', Crypt::encrypt($pago->id)) }}">{{ $pago->id }}</a>
      @else
        {{ $pago->id }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $pago->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_showFields')
  </div>
</div>
@endsection
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
    @include('pago.pag_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pago->pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar pago al pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5><strong>{{ __('Registrar pago al pedido') }}:</strong> {{ $pedido->num_pedido }}</h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
@canany(['pago.fPedido.create', 'venta.pedidoActivo.pago.create'])
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['pago.fPedido.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
        @include('pago.fPedido.fpe_createFields')
      {!! Form::close() !!}
    </div>
  </div>
@endcanany
@include('pago.fPedido.pago.pag_index')
@endsection
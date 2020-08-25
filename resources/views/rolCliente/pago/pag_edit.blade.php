@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pago').' '.$pago->cod_fact)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong> {{ $pago->cod_fact }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    <label for="redes_sociales">{{ __('INFORMACIÓN DEL PAGO') }}</label>
    <div class="border border-primary rounded p-2">
      <div class="row">
        @include('pago.pag_showFields.numeroDePedido')
      </div>
      <div class="row">
        @include('pago.pag_showFields.codigoDeFacturacion')
        @include('pago.pag_showFields.estatusPago')
      </div>
      <div class="row">
        @include('pago.pag_showFields.formaDePago')
        @include('pago.pag_showFields.montoDePago')
      </div>
      @include('pago.pag_showFields.comentarios')
    </div>
    {!! Form::open(['route' => ['rolCliente.pago.update', Crypt::encrypt($pago->id)], 'method' => 'patch', 'id' => 'pagofPedidoUpdate', 'files' => true]) !!}
      @include('pago.fPedido.pago.pag_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
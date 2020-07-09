@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar comprobante de entrega').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @include('logistica.pedido.direccion_local.dirLoc_opcionesComprobantes')
    <h5>
      <strong>{{ __('Registrar comprobante de entrega') }}: {{ $direccion->est }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'logistica.direccionLocal.storeComprobanteDeEntrega', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('logistica.pedido.direccion_local.dirLoc_createComprobanteDeEntregaFields')
    {!! Form::close() !!}
  </div>
</div>
@include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante_de_entrega.comEnt_index')
@endsection
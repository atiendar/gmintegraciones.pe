@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Comprobantes').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @include('logistica.pedido.direccion_local.dirLoc_opcionesComprobantes')
    <h5>{{ __('Comprobantes') }}: {{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})</h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
</div>
@include('logistica.pedido.direccion_local.comprobante_de_salida.com_index')
@endsection
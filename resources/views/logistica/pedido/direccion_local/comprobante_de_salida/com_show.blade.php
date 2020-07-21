@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles comprobante').' '.$comprobante->id)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles comprobante') }}: </strong>
      @can('logistica.direccionLocal.comprobanteDeSalida.edit')
        <a href="{{ route('logistica.direccionLocal.comprobanteDeSalida.edit', Crypt::encrypt($comprobante->id)) }}" class="text-white">{{ $comprobante->id }}</a>
      @else
        {{ $comprobante->id }}
      @endcan
      <strong>{{ __('de la dirección') }}: </strong>{{ $direccion->est }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $comprobante->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('logistica.direccionLocal.show', Crypt::encrypt($direccion->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con la dirección') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection
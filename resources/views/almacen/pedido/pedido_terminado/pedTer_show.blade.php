@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido terminado almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}: </strong> {{ $pedido->num_pedido }}
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('almacen.pedido.pedido_terminado.pedTer_showFields')
  </div>
</div>
@include('almacen.pedido.pedido_terminado.armado_terminado.armTer_index')
@endsection
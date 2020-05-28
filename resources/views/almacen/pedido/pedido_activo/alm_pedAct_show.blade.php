@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Datos generales, estas en el pedido'))</title>
<div class="card {{ empty($pedido->lid_de_ped_alm) ? config('app.color_card_warning') : config('app.color_card_secundario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->lid_de_ped_alm) ? config('app.color_bg_warning') : config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}: </strong>
      @can('almacen.pedidoActivo.edit')
       <a href="{{ route('almacen.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
       {{ $pedido->num_pedido }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->lid_de_ped_alm) ? config('app.color_bg_warning') : config('app.color_bg_secundario') }}"> 
      <small>{{ $pedido->serie.'-'.$pedido->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('almacen.pedido.pedido_activo.alm_pedAct_showFields')
  </div>
</div>
@include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_index')
@endsection



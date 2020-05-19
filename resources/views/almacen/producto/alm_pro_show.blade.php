@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles producto').' '.$producto->produc)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('almacen.producto.edit')
      <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}">{{ $producto->produc }}</a>
      @else
        {{ $producto->produc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $producto->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('almacen.producto.alm_pro_showFields')
  </div>
</div>
@include('almacen.producto.proveedor_producto.alm_pro_proPro_index')
@include('almacen.producto.sustitutos_producto.alm_pro_susPro_index')
@endsection
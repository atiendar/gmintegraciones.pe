@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar proveedor al producto').' '.$producto->produc)</title>
<div class="card c{{ config('app.color_card_primario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Registrar proveedor al producto') }}:</strong> {{ $producto->produc }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.producto.proveedor.store', Crypt::encrypt($producto->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
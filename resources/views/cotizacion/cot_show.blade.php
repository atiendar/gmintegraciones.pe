@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles cotizacion'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('cotizacion.edit')
        <a href="{{ route('cotizacion.edit', Crypt::encrypt($cotizacion->id)) }}">{{ $cotizacion->email_cliente }}</a>
      @else
        {{ $cotizacion->email_cliente }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $cotizacion->serie }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('cotizacion.cot_showFields')
  </div>
</div>
@endsection
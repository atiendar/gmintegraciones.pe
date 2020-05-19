@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles cotizacion').' '.$cotizacion->cliente->email_registro )</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    @canany(['cotizacion.index', 'cotizacion.show', 'cotizacion.edit'])
      <div class="float-right mr-5">
        <a href="{{ route('cotizacion.generarCotizacion', Crypt::encrypt($cotizacion->id)) }}" class='btn btn-light btn-sm border'><i class="fas fa-file-pdf"></i> {{ __('Generar cotización') }}</a>
      </div>
    @endcanany
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('cotizacion.edit')
        <a href="{{ route('cotizacion.edit', Crypt::encrypt($cotizacion->id)) }}">{{ $cotizacion->cliente->email_registro  }}</a>
      @else
        {{ $cotizacion->cliente->email_registro  }}
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
@include('cotizacion.armado_cotizacion.cot_arm_index')
@endsection
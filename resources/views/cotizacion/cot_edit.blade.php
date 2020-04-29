@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar cotización'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('cotizacion.show')
        <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}">{{ $cotizacion->email_cliente }}</a>
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
    {!! Form::open(['route' => ['cotizacion.update', Crypt::encrypt($cotizacion->id)], 'method' => 'patch', 'id' => 'cotizacionUpdate']) !!}
      @include('cotizacion.cot_editFields')
    {!! Form::close() !!}
    <hr>
    @include('cotizacion.armado_cotizacion.cot_arm_index')
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@endsection
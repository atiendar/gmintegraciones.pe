@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado').' '.$armado->nom)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar armado') }}: </strong>{{ $armado->nom }}
      <strong>{{ __('de la cotización') }}: </strong>{{ $armado->cotizacion->serie }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info"> 
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['cotizacion.armado.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'cotizacionArmadoUpdate']) !!}
      @include('cotizacion.armado_cotizacion.cot_arm_editFields')
    {!! Form::close() !!}
  </div>
</div>
@include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_index')
@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_index')
@include('layouts.private.plugins.priv_plu_select2')
@endsection
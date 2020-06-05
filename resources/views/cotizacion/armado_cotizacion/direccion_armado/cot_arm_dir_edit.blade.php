@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar dirección') }}: </strong>{{ $direccion->est }}
      <strong>{{ __('del armado') }}: </strong>{{ $direccion->armado->nom }}
    </h5>  
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['cotizacion.armado.direccion.update', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'cotizacionArmadoDireccionUpdate']) !!}
      @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
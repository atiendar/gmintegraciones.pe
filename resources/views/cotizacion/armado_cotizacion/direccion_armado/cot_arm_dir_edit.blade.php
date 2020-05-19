@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est_a_la_q_se_cotiz)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar dirección') }}: </strong>{{ $direccion->est_a_la_q_se_cotiz }}
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
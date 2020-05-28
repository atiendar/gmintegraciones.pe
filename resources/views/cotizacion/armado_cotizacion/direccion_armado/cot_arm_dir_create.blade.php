@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Cargar dirección al armado').' '.$armado->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Cargar dirección al armado') }}: </strong>{{ $armado->nom }}
      <strong>{{ __('de la cotización') }}: </strong>{{ $armado->cotizacion->serie }}
    </h5>  
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['cotizacion.armado.direccion.store', Crypt::encrypt($armado->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_createFields')
    {!! Form::close() !!}
  </div>
</div>
@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_index')
@endsection
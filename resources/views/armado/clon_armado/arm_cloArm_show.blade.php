@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles armado clonado').' '.$armado->nom)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('armado.clon.edit')
        <a href="{{ route('armado.clon.edit', Crypt::encrypt($armado->id)) }}">{{ $armado->nom }}</a>
      @else
        {{ $armado->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $armado->id }}</small>
    </div>
  </div>
</div>
@include('armado.imagenes_armado.arm_imgArm_index')
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('armado.arm_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('armado.clon.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@include('armado.clon_armado.producto_armado.arm_cloArm_proArm_index')
@endsection
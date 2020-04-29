@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Crear plantilla'))</title>
<div class="card card-info card-outline card-tabs">
  <div class="card-header p-1 border-bottom">
    <h5 class="box-title">{{ __('Crear plantilla') }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'sistema.plantilla.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('sistema.plantilla.sis_pla_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
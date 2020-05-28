@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registro de actividades'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'sistema.actividad.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('sistema.actividad.index'), 'opciones_buscador' => config('opcionesSelect.select_sistema_actividad_index')])
    {!! Form::close() !!}
    @include('sistema.actividad.sis_act_table')
    @include('global.paginador.paginador', ['paginar' => $actividades])
  </div>
</div>
@endsection
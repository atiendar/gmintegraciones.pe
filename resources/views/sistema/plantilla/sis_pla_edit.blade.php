@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar plantilla'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('sistema.plantilla.show')
        <a href="{{ route('sistema.plantilla.show', Crypt::encrypt($plantilla->id)) }}">{{ $plantilla->nom }}</a>
      @else
        {{ $plantilla->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $plantilla->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.plantilla.update', Crypt::encrypt($plantilla->id)], 'method' => 'patch', 'id' => 'sistemaPlantillaUpdate', 'files' => true]) !!}
      @include('sistema.plantilla.sis_pla_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
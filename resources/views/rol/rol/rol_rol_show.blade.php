@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles rol'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('rol.edit')
        <a href="{{ route('rol.edit', Crypt::encrypt($rol->id)) }}">{{ $rol->nom }}</a>
      @else
        {{ $rol->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $rol->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('rol.rol.rol_rol_showFields')
  </div>
</div>
@endsection
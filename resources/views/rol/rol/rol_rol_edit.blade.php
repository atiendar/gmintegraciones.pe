@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar rol').' '.$rol->nom)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('rol.show')
        <a href="{{ route('rol.show', Crypt::encrypt($rol->id)) }}">{{ $rol->nom }}</a>
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
    {!! Form::open(['route' => ['rol.update', Crypt::encrypt($rol->id)], 'method' => 'patch', 'id' => 'rolUpdate']) !!}
      @include('rol.rol.rol_rol_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
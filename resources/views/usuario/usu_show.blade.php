@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles usuario').' '.$usuario->nom)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('usuario.edit')
        <a href="{{ route('usuario.edit', Crypt::encrypt($usuario->id)) }}">{{ $usuario->nom }}</a>
      @else
        {{ $usuario->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $usuario->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('usuario.usu_showFields')
  </div>
</div>
@endsection
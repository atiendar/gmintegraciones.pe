@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles cliente'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('cliente.edit')
        <a href="{{ route('cliente.edit', Crypt::encrypt($cliente->id)) }}">{{ $cliente->nom }}</a>
      @else
        {{ $cliente->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $cliente->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('cliente.cli_showFields')
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles serie'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('sistema.serie.edit')
        <a href="{{ route('sistema.serie.edit', Crypt::encrypt($serie->id)) }}">{{ $serie->vista }}</a>
      @else
        {{ $serie->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $serie->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('sistema.serie.sis_ser_showFields')
  </div>
</div>
@endsection
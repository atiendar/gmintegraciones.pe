@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles soporte'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del solicitante') }}:</strong>
      <a href="{{ route('soporte.edit', Crypt::encrypt($soporte->id)) }}">{{ $soporte->sol }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $soporte->id }}</small>
    </div>
  </div>
</div>
  @include('tecnologia_de_la_informacion.soporte.ti_sop_tablaEditFields')
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('tecnologia_de_la_informacion.soporte.ti_sop_showFields')
  </div>
</div>
@endsection
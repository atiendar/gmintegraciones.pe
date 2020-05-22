@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles queja y sugerencia').' '.$queja_y_sugerencia->id)</title>
<div class="row">
  <div class="col-md-8">
    <div class="pad">
      <div class="card card-info card-outline card-tabs position-relative bg-white">
        <div class="card-header p-1 border-botton">
          <h5>
            <strong>{{ __('Detalles del registro') }}: </strong>{{ $queja_y_sugerencia->id }}
          </h5>
        </div>
        <div class="ribbon-wrapper">
          <div class="ribbon bg-info">
            <small>{{ $queja_y_sugerencia->id }}</small>
          </div>
        </div>
        <div class="card-body">
          @include('queja_y_sugerencia.qsu_showFields')
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    @include('queja_y_sugerencia.archivo.arc_index')
  </div>
</div>
@endsection
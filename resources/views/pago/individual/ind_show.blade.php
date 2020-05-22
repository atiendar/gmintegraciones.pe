@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pago').' '.$pago->cod_fact)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('pago.edit')
        <a href="{{ route('pago.edit', Crypt::encrypt($pago->id)) }}">{{ $pago->cod_fact }}</a>
      @else
        {{ $pago->cod_fact }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('pago.pag_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('pago.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection
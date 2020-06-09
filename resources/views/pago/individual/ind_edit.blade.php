@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pago').' '.$pago->cod_fact)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('pago.show')
        <a href="{{ route('pago.show', Crypt::encrypt($pago->id)) }}" class="text-white">{{ $pago->cod_fact }}</a>
      @else
        {{ $pago->cod_fact }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['pago.update', Crypt::encrypt($pago->id)], 'method' => 'patch', 'id' => 'pagoUpdate', 'files' => true]) !!}
      @include('pago.individual.ind_editFields')
      <div class="row">
        <div class="form-group col-sm btn-sm" >
          <a href="{{ route('pago.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'pagoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
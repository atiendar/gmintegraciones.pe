@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Registrar pago'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('pago.pag_menu')
    </ul>
  </div>
  <div class="card-body">
      @include('pago.pag_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('pago.index', Crypt::encrypt($pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
  </div>
</div>
@endsection
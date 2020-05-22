@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Registrar pago al pedido').' '.$pedido->num_pedido)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5><strong>{{ __('Registrar pago al pedido') }}: </strong>{{ $pedido->num_pedido }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['venta.pedidoActivo.pago.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('pago.pag_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar pago') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@include('venta.pedido.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_index')
@endsection
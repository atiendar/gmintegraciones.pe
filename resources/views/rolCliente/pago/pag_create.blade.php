@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar direccion'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.pago.pag_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'rolCliente.pago.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="numero_de_pedido">{{ __('Número de pedido') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-list"></i></span>
            </div>
            {!! Form::select('numero_de_pedido', $num_pedidos, null, ['class' => 'form-control select2' . ($errors->has('numero_de_pedido') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('numero_de_pedido') }}</span>
        </div>
      </div>
      @include('pago.fPedido.fpe_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('rolCliente.pago.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
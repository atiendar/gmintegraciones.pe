@extends('pago.fPedido.fpe_createIndex')
@section('createPago')
  {!! Form::open(['route' => ['pago.fPedido.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
    @include('pago.fPedido.fpe_createFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <a href="{{ route('pago.fPedido.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
      </div>
      <div class="form-group col-sm btn-sm">
        <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
      </div>
    </div>
  {!! Form::close() !!}
@endsection
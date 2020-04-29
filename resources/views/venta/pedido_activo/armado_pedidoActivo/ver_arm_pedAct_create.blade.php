@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Cargar armado'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5><strong>{{ __('Cargar armado al pedido') }}: </strong>{{ $pedido->serie.$pedido->id }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['venta.pedidoActivo.armado.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('venta.pedido_activo.armado_pedidoActivo.ver_arm_pedAct_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
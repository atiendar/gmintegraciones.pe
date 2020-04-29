@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Registrar pago'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5><strong>{{ __('Registrar pago al pedido') }}: </strong>{{ $pedido->serie.$pedido->id }}</h5>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_createFields')
  </div>
</div>
@endsection
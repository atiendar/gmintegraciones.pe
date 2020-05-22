@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido').' '.$pedido->num_pedido)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5><strong>{{ __('Registrar pago al pedido') }}:</strong> {{ $pedido->num_pedido }}</h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  <div class="card-body">
      ddd
    </div>
</div>
@include('pago.fPedido.pago.pag_index')
@endsection
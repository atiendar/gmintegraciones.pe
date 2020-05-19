@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado').' '.$armado->cod)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Editar armado') }}:</strong>
      @can('venta.pedidoActivo.armado.show')
        <a href="{{ route('venta.pedidoActivo.armado.show', Crypt::encrypt($armado->id)) }}">{{ $armado->cod }}</a>,
      @else
        {{ $armado->cod }},
      @endcan
     <strong>{{ __('del pedido') }}:</strong> {{ $armado->pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $armado->cod }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_editFields')
  </div>
</div>
@endsection
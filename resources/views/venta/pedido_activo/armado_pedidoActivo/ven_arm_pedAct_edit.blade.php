@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('almacen.pedidoAlmacen.ArmadoPedido.show')
        <a href="{{ route('almacen.pedidoAlmacen.ArmadoPedido.show', Crypt::encrypt($armado->id)) }}">{{ $armado->id }}</a>
      @else
        {{ $armado->id }}
      @endcan
      <strong>{{ __('del pedido') }}:</strong> {{ $armado->pedido->num_ped_unif }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.pedidoAlmacen.ArmadoPedido.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'armadoPedidoUpdate', 'files' => true]) !!}
      @include('venta.pedido_activo.armado_pedidoActivo.arm_pedAct_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection


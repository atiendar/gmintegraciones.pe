@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar armado') }}:</strong>
      @can('logistica.pedidoActivoLocal.armado.show')
        <a href="{{ route('logistica.pedidoActivoLocal.armado.show', Crypt::encrypt($armado->id)) }}" class="text-white">{{ $armado->cod }}</a>,
      @else
        {{ $armado->cod }},
      @endcan
     <strong>{{ __('del pedido') }}:</strong> {{ $pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $armado->cod }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['logistica.pedidoActivoLocal.armado.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoArmadoUpdate']) !!}
      {{--   @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_editFields') --}}
    {!! Form::close() !!}
  </div>
</div>
@include('logistica.pedido.pedido_activo.armado_activo.direccion.arm_dir_index')
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->lid_de_ped_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->lid_de_ped_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido almacén') }}: </strong>
      @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->lid_de_ped_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('almacen.pedidoActivo.edit')
    <div class="col-md-8">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['almacen.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoUpdate']) !!}
                @include('almacen.pedido.pedido_activo.alm_pedAct_editFields')
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
</div>
@include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_index')
@endsection
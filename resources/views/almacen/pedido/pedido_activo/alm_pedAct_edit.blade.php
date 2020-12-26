
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
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
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('almacen.pedidoActivo.edit')
    <div class="col-md-7">
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



{{-- 
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
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
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>




<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5><strong>{{ __('PRODUCTOS') }}</h5>
  </div>
  <div class="card-body">

    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        <tbody>
        @foreach($productos as $producto)
        <tr>
          <td>
            {{ $producto['cantidad'] }} - {{ $producto['nombre_producto'] }}
            @foreach($producto['sustitutos'] as $sustituto)
              <div class="input-group text-muted ml-4">
                {{ $sustituto->cant }} - {{ $sustituto->produc }}
              </div>
            @endforeach
          </td>
        
      
      
        
      
      
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection


--}}
















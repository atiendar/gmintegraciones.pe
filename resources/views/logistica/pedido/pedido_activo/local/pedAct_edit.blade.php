@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo local').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->lid_de_ped_produc) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusLogisticaHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido local') }}: </strong>
      @can('logistica.pedidoActivoLocal.show')
        <a href="{{ route('logistica.pedidoActivoLocal.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('logistica.pedidoActivoLocal.edit')
    <div class="col-md-8">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['logistica.pedidoActivoLocal.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'logisticaPedidoActivoLocalUpdate']) !!}
                @include('logistica.pedido.pedido_activo.pedAct_editFields')
                <div class="row">
                  <div class="form-group col-sm btn-sm" >
                    <a href="{{ route('logistica.pedidoActivoLocal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
                  </div>
                  <div class="form-group col-sm btn-sm">
                    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'logisticaPedidoActivoLocalUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar pedido') }}</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @can('logistica.pedidoActivoLocal.edit')
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
  @endcan
</div>
@include('logistica.pedido.pedido_activo.armado_activo.armAct_index', ['ruta' => 'logistica.pedidoActivoLocal.edit', 'ruta_show' => 'logistica.pedidoActivoLocal.armado.show', 'canany_show'=> ['logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.show'], 'ruta_opciones' => 'logistica.pedido.pedido_activo.armado_activo.armAct_tableOpciones'])
@endsection
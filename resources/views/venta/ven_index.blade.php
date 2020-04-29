@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', 'Inicio ventas')</title>

<div class="row">
  <div class="col-lg-2">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ __('Pedidos') }}</h3>
        <div class="btn-group">
          <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Ver más') }}
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('venta.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
            <a href="{{ route('venta.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }}</a>
            <a href="{{ route('venta.pedidoActivo.create') }}" class="dropdown-item"><i class="far fa-plus-square"></i> {{ __('Registrar pedido') }}</a>
          </div>
        </div>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-bag"></i>
      </div>
    </div>
  </div>
</div>





@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio logística'))</title>
<div class="row">
  @canany([
    'logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit',
    'logistica.pedidoTerminado.index','logistica.pedidoTerminado.show'
  ])
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Pedidos') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['logistica.pedidoActivo.index','logistica.pedidoActivo.show','logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit'])
                <a href="{{ route('logistica.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              <a href="{{ route('logistica.direccionLocal.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de armados locales') }}</a>
              <a href="{{ route('logistica.direccionForaneo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de armados foráneos') }}</a>
              @canany(['logistica.pedidoTerminado.index','logistica.pedidoTerminado.show'])
                <a href="{{ route('logistica.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos entregados') }} (-90d)</a>
              @endcanany
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
  @endcanany
</div>
@endsection
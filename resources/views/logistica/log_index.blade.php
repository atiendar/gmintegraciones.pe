@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio logística'))</title>
<div class="row">
  @canany([
    'logistica.pedidoActivoLocal.index', 'logistica.pedidoActivoLocal.show', 'logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.armado.edit',
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
              @canany(['logistica.pedidoActivoLocal.index', 'logistica.pedidoActivoLocal.show', 'logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.armado.edit'])
                <a href="{{ route('logistica.pedidoActivoLocal.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos locales') }}</a>
              @endcanany
              @canany(['logistica.pedidoActivoForaneo.index', 'logistica.pedidoActivoForaneo.show', 'logistica.pedidoActivoForaneo.edit', 'logistica.pedidoActivoForaneo.armado.show', 'logistica.pedidoActivoForaneo.armado.edit'])
                <a href="{{ route('logistica.pedidoActivoLocal.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos foráneos') }}</a>
              @endcanany
              @canany(['logistica.pedidoTerminado.index','logistica.pedidoTerminado.show'])
                <a href="{{ route('logistica.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }} (-90d)</a>
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
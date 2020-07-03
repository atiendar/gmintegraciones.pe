@canany(['logistica.pedidoActivoLocal.index', 'logistica.pedidoActivoLocal.show', 'logistica.pedidoActivoLocal.edit'])
  <li class="nav-item">
    <a href="{{ route('logistica.pedidoActivoLocal.index') }}" class="nav-link {{ Request::is('logistica/pedido-activo/local') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos locales') }}
    </a>
  </li>
@endcanany
@canany(['logistica.pedidoActivoForaneo.index', 'logistica.pedidoActivoForaneo.show', 'logistica.pedidoActivoForaneo.edit'])
  <li class="nav-item">
    <a href="" class="nav-link {{ Request::is('logistica/pedido-activo/foraneo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos foráneos') }}
    </a>
  </li>
@endcanany
@canany(['logistica.pedidoTerminado.index', 'logistica.pedidoTerminado.show'])
  <li class="nav-item">
    <a href="{{ route('logistica.pedidoTerminado.index') }}" class="nav-link {{ Request::is('logistica/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }} (-90d)
    </a>
  </li>
@endcanany
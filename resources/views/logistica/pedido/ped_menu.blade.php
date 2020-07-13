@canany(['logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('logistica.pedidoActivo.index') }}" class="nav-link {{ Request::is('logistica/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany([''])
  <li class="nav-item">
    <a href="{{ route('logistica.direccionLocal.index') }}" class="nav-link {{ Request::is('logistica/direccion-local') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones locales') }}
    </a>
  </li>
@endcanany
@canany([''])
  <li class="nav-item">
    <a href="{{ route('logistica.direccionForaneo.index') }}" class="nav-link {{ Request::is('logistica/direccion-foraneo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones foráneos') }}
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
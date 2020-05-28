@canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.create', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy'])
  <li class="nav-item">
    <a href="{{ route('venta.pedidoActivo.index') }}" class="nav-link {{ Request::is('venta/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['venta.pedidoTerminado.index',])
  <li class="nav-item">
    <a href="{{ route('venta.pedidoTerminado.index') }}" class="nav-link {{ Request::is('venta/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }}
    </a>
  </li>
@endcanany
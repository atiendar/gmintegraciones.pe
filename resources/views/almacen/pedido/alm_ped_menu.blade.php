@canany(['almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('almacen.pedidoActivo.index') }}" class="nav-link {{ Request::is('almacen/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@can('almacen.pedidoTerminado.index')
  <li class="nav-item">
    <a href="{{ route('almacen.pedidoTerminado.index') }}" class="nav-link {{ Request::is('almacen/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }} (+-90d)
    </a>
  </li>
@endcan
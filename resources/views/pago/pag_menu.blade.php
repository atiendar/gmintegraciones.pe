@canany(['pago.fPedido.index', 'pago.fPedido.create', 'pago.fPedido.show', 'pago.fPedido.edit'])
  <li class="nav-item">
    <a href="{{ route('pago.fPedido.index') }}" class="nav-link {{ Request::is('pago/f-pedido') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (F. por pedido)') }}
    </a>
  </li>
@endcanany
@canany(['pago.index', 'pago.show', 'pago.edit', 'pago.destroy', 'pago.marcarComoFacturado'])
  <li class="nav-item">
    <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago/individual') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (Individual)') }}
    </a>
  </li>
@endcanany
@canany(['pago.index'])
  <li class="nav-item">
    <a href="{{ route('pago.fPedido.index') }}" class="nav-link {{ Request::is('pago/f-pedido') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (F. por pedido)') }}
    </a>
  </li>
@endcanany
@can('pago.index')
<li class="nav-item">
    <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (Individual)') }}
    </a>
  </li>
@endcan
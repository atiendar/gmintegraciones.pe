@canany(['pago.index'])
  <li class="nav-item">
    <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago*') ? 'active' : '' }}">
      <i class="nav-icon far fa-money-bill-alt"></i>
      <p>{{ __('Pagos') }}</p>
    </a>
  </li>
@endcanany
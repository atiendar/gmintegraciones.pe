@canany(['factura.index', 'factura.create', 'factura.show', 'factura.edit', 'factura.destroy'])
  <li class="nav-item">
    <a href="{{ route('factura.index') }}" class="nav-link {{ Request::is('factura') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de facturas') }}
    </a>
  </li>
@endcanany
@can('factura.create')
  <li class="nav-item">
    <a href="{{ route('factura.create') }}" class="nav-link {{ Request::is('factura/solicitar') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Solicitar factura') }}
    </a>
  </li>
@endcan
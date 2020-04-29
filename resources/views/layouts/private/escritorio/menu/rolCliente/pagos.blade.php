<li class="nav-item has-treeview {{ Request::is('rc/pagos*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('rc/pagos*') ? 'active' : '' }}">
    <i class="nav-icon far fa-money-bill-alt"></i>
    <p>
      {{ __('Pagos') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="" class="nav-link {{ Request::is('rc/pagos') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de pagos') }}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="" class="nav-link {{ Request::is('rc/pagos/registrar') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Registrar pago') }}</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item has-treeview {{ Request::is('rc/quejas-y-sugerencias*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('rc/quejas-y-sugerencias*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-inbox"></i>
    <p>
      {{ __('Quejas y sugerencias') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="" class="nav-link {{ Request::is('rc/quejas-y-sugerencias') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de quejas y sugerencias') }}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="" class="nav-link {{ Request::is('rc/quejas-y-sugerencias/registrar') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Registrar') }}</p>
      </a>
    </li>
  </ul>
</li>
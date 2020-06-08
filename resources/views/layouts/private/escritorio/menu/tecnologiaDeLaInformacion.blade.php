@canany(['prueebaa'])
<li class="nav-item has-treeview {{ Request::is('ti*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('ti*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-desktop"></i>
    <p>
      {{ __('Tecnologías de la información') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('soporte.index') }}" class="nav-link {{ Request::is('ti/soporte*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de soportes') }}</p>
      </a>
    </li>







    <li class="nav-item has-treeview {{ Request::is('ti/inventario*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ Request::is('ti/inventario*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-dolly-flatbed"></i>
        <p>
          {{ __('Inventario') }}
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" class="nav-link {{ Request::is('ti/inventario') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de inventario') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{ Request::is('ti/inventario/crear') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Registrar en inventario') }}</p>
          </a>
        </li>
      </ul>
    </li>













  </ul>
</li>
@endcanany
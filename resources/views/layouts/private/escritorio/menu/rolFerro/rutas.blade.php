@canany(['ruta.index', 'ruta.create', 'ruta.show', 'ruta.edit', 'ruta.destroy'])
  <li class="nav-item has-treeview {{ Request::is('f/ruta*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('f/ruta*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-user-tie"></i>
      <p>
        {{ __('Rutas') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['ruta.index', 'ruta.create', 'ruta.show', 'ruta.edit', 'ruta.destroy'])
        <li class="nav-item">
          <a href="" class="nav-link {{ Request::is('f/ruta') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de rutas') }}</p>
          </a>
        </li>
      @endcanany
      @can('ruta.create')
        <li class="nav-item">
          <a href="" class="nav-link {{ Request::is('f/ruta/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar ruta') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany
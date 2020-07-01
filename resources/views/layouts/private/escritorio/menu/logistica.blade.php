@canany([
  'logistica.pedidoActivoLocal.index', 'logistica.pedidoActivoLocal.show', 'logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.armado.edit',
  'logistica.pedidoTerminado.index','logistica.pedidoTerminado.show'
])
  <li class="nav-item has-treeview {{ Request::is('logistica*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('logistica*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-truck"></i>
      <p>
        {{ __('Logística') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('logistica.index') }}" class="nav-link {{ Request::is('inicio-logistica') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>{{ __('Inicio logística') }}</p>
        </a>
      </li>
      @canany(['logistica.pedidoActivoLocal.index','logistica.pedidoActivoLocal.show','logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.armado.edit', 'logistica.pedidoTerminado.index','logistica.pedidoTerminado.show'])
        <li class="nav-item has-treeview {{ Request::is('logistica/pedido*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('logistica/pedido*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              <p>{{ __('Pedidos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            @canany(['logistica.pedidoActivoLocal.index','logistica.pedidoActivoLocal.show','logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.show', 'logistica.pedidoActivoLocal.armado.edit'])
              <li class="nav-item">
                <a href="" class="nav-link {{ Request::is('logistica/pedido-activo/local') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos locales') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.pedidoActivoForaneo.index', 'logistica.pedidoActivoForaneo.show', 'logistica.pedidoActivoForaneo.edit', 'logistica.pedidoActivoForaneo.armado.show', 'logistica.pedidoActivoForaneo.armado.edit'])
              <li class="nav-item">
                <a href="" class="nav-link {{ Request::is('logistica/pedido-activo/foraneo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos foráneos') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.pedidoTerminado.index', 'logistica.pedidoTerminado.show'])
              <li class="nav-item">
                <a href="" class="nav-link {{ Request::is('logistica/pedido-terminado') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos terminados') }}</p>
                </a>
              </li>
            @endcanany
          </ul>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany
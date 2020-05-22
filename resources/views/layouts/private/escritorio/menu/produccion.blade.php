{{-- 
@canany(['produccion.pedidoActivo.index'])
  <li class="nav-item has-treeview {{ Request::is('produccion*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('produccion*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-cart-plus"></i>
      <p>
        {{ __('Producción') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="" class="nav-link {{ Request::is('inicio-produccion') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>{{ __('Inicio producción') }}</p>
        </a>
      </li>
      <li class="nav-item has-treeview {{ Request::is('produccion/pedido*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('produccion/pedido*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-shopping-bag"></i>
          <p>
            <p>{{ __('Pedidos producción') }}</p>
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview ">
          @canany(['produccion.pedidoActivo.index'])
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::is('produccion/pedido-activo') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de pedidos activos') }}</p>
              </a>
            </li>
          @endcanany
          @canany(['produccion.pedidoTerminado.index'])
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::is('produccion/pedido-terminado') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de pedidos terminados') }}</p>
              </a>
            </li>
          @endcanany
        </ul>
      </li>
    </ul>
  </li>
@endcanany
--}}














{{--
@canany(['pruebaaaa'])

<li class="nav-item">
<a href="" class="nav-link {{ Request::is('nomina*') ? 'active' : '' }}">
  <i class="nav-icon fas fa-money-check"></i>
  <p>{{ __('Nomina') }}</p>
</a>
</li>
<li class="nav-item">
<a href="" class="nav-link {{ Request::is('rastrear-pedido*') ? 'active' : '' }}">
  <i class="nav-icon fas fa-search"></i>
  <p>{{ __('Rastrear pedido') }}</p>
</a>
</li>
<li class="nav-item has-treeview {{ Request::is('servicios*') ? 'menu-open' : '' }}">
<a href="#" class="nav-link {{ Request::is('servicios*') ? 'active' : '' }}">
  <i class="nav-icon fas fa-phone"></i>
  <p>
    {{ __('Servicios') }}
    <i class="right fas fa-angle-left"></i>
    <span class="badge badge-info right">3</span>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('servicios') ? 'active' : '' }}">
      <i class="nav-icon fas fa-list"></i>
      <p>{{ __('Lista de servicios') }}</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link" data-toggle="modal" data-target="#log_create" data-backdrop="static" data-keyboard="false">
      <i class="nav-icon far fa-plus-square"></i>
      <p>{{ __('Registrar') }}</p>
    </a>
  </li>
</ul>
</li>
@endcanany

@canany(['pruebaaaa'])
<li class="nav-item has-treeview {{ Request::is('armado-de-regalo*') ? 'menu-open' : '' }}">
<a href="#" class="nav-link {{ Request::is('armado-de-regalo*') ? 'active' : '' }}">
  <i class="nav-icon fas fa-gifts"></i>
  <p>
    {{ __('Armados de regalo') }}
    <i class="right fas fa-angle-left"></i>
    <span class="badge badge-info right">10</span>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('armado-de-regalo') ? 'active' : '' }}">
      <i class="nav-icon fas fa-list"></i>
      <p>{{ __('Lista de armados de regalo') }}</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('armado-de-regalo') ? 'active' : '' }}">
      <i class="nav-icon far fa-plus-square"></i>
      <p>{{ __('Registrar armado de regalo') }}</p>
    </a>
  </li>
</ul>
</li>
@endcanany
@canany(['pruebaaaa'])
<li class="nav-item has-treeview {{ Request::is('logistica*') ? 'menu-open' : '' }}">
<a href="#" class="nav-link {{ Request::is('logistica*') ? 'active' : '' }}">
  <i class="nav-icon fas fa-shipping-fast"></i>
  <p>
    {{ __('Logística') }}
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('logistica') ? 'active' : '' }}">
      <i class="nav-icon fas fa-list"></i>
      <p>{{ __('Lista de logística') }}</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link" data-toggle="modal" data-target="#log_create" data-backdrop="static" data-keyboard="false">
      <i class="nav-icon far fa-plus-square"></i>
      <p>{{ __('Registrar') }}</p>
    </a>
  </li>
</ul>
</li>
@endcanany
--}}
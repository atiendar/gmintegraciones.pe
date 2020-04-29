@canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
  <li class="nav-item">
    <a href="{{ route('almacen.producto.index') }}" class="nav-link {{ Request::is('almacen/producto') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de productos') }}
    </a>
  </li>
@endcanany
@can('almacen.producto.create')
  <li class="nav-item">
    <a href="{{ route('almacen.producto.create') }}" class="nav-link {{ Request::is('almacen/producto/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar producto') }}
    </a>
  </li>
@endcan
@can('almacen.producto.index')
  <li class="nav-item ml-auto">
    {!! Form::open(['route' => 'almacen.producto.generarReporteDeCompra', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit1")']) !!}
      <button type="submit" id="btnsubmit1" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i>  {{ __('Generar reporte de compra') }}</button>
    {!! Form::close() !!}
  </li>
@endcan
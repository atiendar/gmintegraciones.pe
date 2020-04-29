@if(auth()->user()->hasRole(config('app.rol_cliente')))
<li class="nav-header">{{ __('MÓDULOS') }}</li>
  @include('layouts.private.escritorio.menu.rolCliente.quejasYSugerencias')
  @include('layouts.private.escritorio.menu.rolCliente.direccion')
  @include('layouts.private.escritorio.menu.rolCliente.pedidos')
  @include('layouts.private.escritorio.menu.rolCliente.pagos')
  @include('layouts.private.escritorio.menu.rolCliente.facturas')
@else
  @canany(['sistema.edit', 
  'sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy', 
  'sistema.notificacion.create', 
  'sistema.actividad.index',
  'sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy',
  'sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy',
  'usuario.index', 'usuario.create', 'usuario.show', 'usuario.edit', 'usuario.destroy',
  'cliente.index', 'cliente.create', 'cliente.show', 'cliente.edit', 'cliente.destroy',
  'rol.permiso.index', 'rol.index', 'rol.create', 'rol.show', 'rol.edit', 'rol.destroy',
  'papeleraDeReciclaje.index', 'papeleraDeReciclaje.destroy', 'papeleraDeReciclaje.restore'])
    <li class="nav-header">{{ __('SISTEMA') }}</li>
  @endcanany
  @include('layouts.private.escritorio.menu.sistema')
  @include('layouts.private.escritorio.menu.usuarios')
  @include('layouts.private.escritorio.menu.clientes')
  @include('layouts.private.escritorio.menu.roles')
  @include('layouts.private.escritorio.menu.papeleraDeReciclaje')

  @canany([
    'proveedor.index', 'proveedor.create', 'proveedor.show', 'proveedor.edit', 'proveedor.destroy', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.show', 'proveedor.contacto.edit', 'proveedor.contacto.destroy',
    'armado.index', 'armado.create', 'armado.show', 'armado.edit', 'armado.destroy', 'armado.clon.index', 'armado.clon.create', 'armado.clon.show', 'armado.clon.edit', 'armado.clon.destroy', 'armado.producto.store', 'armado.producto.destroy', 'armado.producto.editCantidad', 'armado.clon.producto.store', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad',
    'almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.destroy'
  ])
    <li class="nav-header">{{ __('MÓDULOS') }}</li>
  @endcanany
  @include('layouts.private.escritorio.menu.cotizaciones')
  @include('layouts.private.escritorio.menu.proveedores')
  @include('layouts.private.escritorio.menu.armados')
  @include('layouts.private.escritorio.menu.ventas')
  @include('layouts.private.escritorio.menu.almacen')
  @include('layouts.private.escritorio.menu.produccion')
@endif
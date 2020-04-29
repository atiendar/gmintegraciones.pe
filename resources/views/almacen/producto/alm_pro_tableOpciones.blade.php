<td width="1rem" title="Editar: {{ $producto->sku }}">
  @canany(['almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
    <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Eliminar: {{ $producto->sku }}">
  @can('almacen.producto.destroy')
    <form method="post" action="{{ route('almacen.producto.destroy', Crypt::encrypt($producto->id)) }}" id="productoDestroy{{ $producto->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$producto->id", 'onclick' => "return check('btnsub$producto->id', 'productoDestroy$producto->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $producto->id ($producto->sku) ? Eliminaras toda relación con sus armados.', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
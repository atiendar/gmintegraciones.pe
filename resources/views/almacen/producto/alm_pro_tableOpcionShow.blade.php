<td>
  @can('almacen.producto.show')
    <a href="{{ route('almacen.producto.show', Crypt::encrypt($producto->id)) }}" title="Detalles: {{ $producto->sku }}">{{ $producto->sku }}</a>
  @else
    {{ $producto->sku }}
  @endcan
</td>
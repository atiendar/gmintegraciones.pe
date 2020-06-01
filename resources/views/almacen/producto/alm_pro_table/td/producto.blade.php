<td>
  @can('almacen.producto.show')
    <a href="{{ route('almacen.producto.show', Crypt::encrypt($producto->id)) }}" target="_blank">{{ $producto->produc }}</a>
  @else
    {{ $producto->produc }}
  @endcan
</td>
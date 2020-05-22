<td>
  @can('almacen.pedidoActivo.armadoPedidoActivo.show')
    <a href="{{ route('almacen.pedidoActivo.armadoPedidoActivo.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->cod }}">{{ $armado->cod }}</a>
  @else
    {{ $armado->cod }}
  @endcan
</td>
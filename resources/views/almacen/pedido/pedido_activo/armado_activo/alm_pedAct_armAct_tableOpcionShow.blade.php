<td>
  @can('almacen.pedidoActivo.armado.show')
    <a href="{{ route('almacen.pedidoActivo.armado.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->cod }}">{{ $armado->cod }}</a>
  @else
    {{ $armado->cod }}
  @endcan
</td>
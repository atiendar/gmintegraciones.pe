<td width="1rem" title="Detalles: {{ $pago->id }}">
  @can('venta.pedidoActivo.pago.show')
    <a href="{{ route('venta.pedidoActivo.pago.show', Crypt::encrypt($pago->id)) }}" title="Detalles: {{ $pago->id }}">{{ $pago->id  }}</a>
  @else
    {{ $pago->id  }}
  @endcan
</td>
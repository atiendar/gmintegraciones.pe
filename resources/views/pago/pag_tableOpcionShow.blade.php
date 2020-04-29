<td width="1rem" title="Detalles: {{ $pago->id }}">
  @can('pago.show')
    <a href="" title="Detalles: {{ $pago->id }}">{{ $pago->id  }}</a>
  @else
    {{ $pago->id  }}
  @endcan
</td>
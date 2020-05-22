<td title="Detalles: {{ $pago->cod_fact }}">
  @can('pago.fPedido.show')
    <a href="{{ route('pago.fPedido.show', Crypt::encrypt($pago->id)) }}" title="Detalles: {{ $pago->cod_fact }}">{{ $pago->cod_fact  }}</a>
  @else
    {{ $pago->cod_fact  }}
  @endcan
</td>
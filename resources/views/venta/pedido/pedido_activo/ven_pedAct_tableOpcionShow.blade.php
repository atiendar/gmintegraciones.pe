<td>
  @canany(['venta.pedidoActivo.show'])
    <a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" title="Detalles: {{ $pedido->num_pedido }}">{{ $pedido->num_pedido }}</a>
  @else
    {{ $pedido->num_pedido }}
  @endcanany
</td>
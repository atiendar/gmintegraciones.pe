<td>
  @canany(['venta.pedidoActivo.show'])
    <a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" title="Detalles: {{ $pedido->serie }}">{{ $pedido->serie }}</a>
  @else
    {{ $pedido->serie }}
  @endcanany
</td>
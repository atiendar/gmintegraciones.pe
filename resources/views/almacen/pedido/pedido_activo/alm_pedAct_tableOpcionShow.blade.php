<td>
  @can('almacen.pedidoActivo.show')
    <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" title="Detalles: {{ $pedido->serie.$pedido->id }}">{{ $pedido->serie.$pedido->id }}</a>
  @else
    {{ $pedido->serie.$pedido->id }}
  @endcan
</td>
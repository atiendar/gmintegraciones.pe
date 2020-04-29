<td>
  @foreach($pedido->unificar as $unificado)
    <a href="{{ route('venta.rastrearPedido.rastrear', Crypt::encrypt($pedido->id)) }}" target="_blank">{{ $unificado->serie }}</a> /
  @endforeach
</td>
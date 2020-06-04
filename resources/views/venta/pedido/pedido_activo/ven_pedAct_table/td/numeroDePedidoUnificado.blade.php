<td>
  @foreach($pedido->unificar as $unificado)
    @canany(['rastrea.pedido.show', 'rastrea.pedido.showFull'])
      [<a href="{{ route('rastrea.pedido.show', Crypt::encrypt($unificado->id)) }}" target="_blank">{{ $unificado->num_pedido }}</a>]
    @endcanany
  @endforeach
</td>
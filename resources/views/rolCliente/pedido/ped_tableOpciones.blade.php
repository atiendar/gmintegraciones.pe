<td width="1rem" title="Detallar pedido: {{ $pedido->num_pedido }}">
  @if($pedido->estat_log != config('app.entregado'))
    <a href="{{ route('rolCliente.pedido.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-info'><i class="far fa-clipboard"></i></a>
  @endif
</td>
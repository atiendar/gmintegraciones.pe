<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @can('pago.fPedido.edit')
    <a href="{{ route('pago.fPedido.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Registrar pago: {{ $pedido->num_pedido }}">
  @can('pago.fPedido.create')
    <a href="{{ route('pago.fPedido.create', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
  @endcan
</td>
<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @canany(['logistica.pedidoActivoLocal.edit', 'logistica.pedidoActivoLocal.armado.edit'])
    <a href="{{ route('logistica.pedidoActivoLocal.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
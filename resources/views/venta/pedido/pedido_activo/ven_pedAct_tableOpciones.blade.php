<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @canany(['venta.pedidoActivo.edit'])
    <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Eliminar: {{ $pedido->num_pedido }}">
  @can('venta.pedidoActivo.destroy')
    <form method="post" action="{{ route('venta.pedidoActivo.destroy', Crypt::encrypt($pedido->id)) }}" id="ventaPedidoActivoDestroy{{ $pedido->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$pedido->id", 'onclick' => "return check('btnsub$pedido->id', 'ventaPedidoActivoDestroy$pedido->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $pedido->num_pedido (".$pedido->usuario->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
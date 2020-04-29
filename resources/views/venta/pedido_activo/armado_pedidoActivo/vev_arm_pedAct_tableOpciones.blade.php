<td width="1rem" title="Editar: {{ $armado->cod }}">
  @can('venta.pedidoActivo.armado.edit')
    <a href="{{ route('venta.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $armado->cod }}">
  @can('venta.pedidoActivo.armado.destroy')
    <form method="post" action="{{ route('venta.pedidoActivo.armado.destroy', Crypt::encrypt($armado->id)) }}" id="ventaPedidoActivoArmadoDestroy{{ $armado->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$armado->id", 'onclick' => "return check('btnsub$armado->id', 'ventaPedidoActivoArmadoDestroy$armado->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $armado->cod ($armado->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
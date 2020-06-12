<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @can('pago.edit')
    <a href="{{ route('pago.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $pago->cod_fact }}">
  @can('pago.destroy')
    <form method="post" action="{{ route('pago.destroy', Crypt::encrypt($pago->id)) }}" id="pagoDestroy{{ $pago->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$pago->id", 'onclick' => "return check('btnsub$pago->id', 'pagoDestroy$pago->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información (Factura). ¿Estás seguro que quieres realizar esta acción para el registro: $pago->cod_fact ($pago->cod_fact) ? ', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
<td width="1rem" title="Editar: {{ $cotizacion->email_cliente }}">
  @can('cotizacion.edit')
    <a href="{{ route('cotizacion.edit', Crypt::encrypt($cotizacion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $cotizacion->email_cliente }}">
  @can('cotizacion.destroy')
    <form method="post" action="{{ route('cotizacion.destroy', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionDestroy{{ $cotizacion->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$cotizacion->id", 'onclick' => "return check('btnsub$cotizacion->id', 'cotizacionDestroy$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $cotizacion->id ($cotizacion->email_cliente) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
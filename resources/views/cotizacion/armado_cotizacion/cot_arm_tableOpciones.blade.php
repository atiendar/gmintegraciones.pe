<td width="1rem" title="Eliminar: {{ $armado->nom }}">
  <form method="post" action="{{ route('cotizacion.armado.destroy', Crypt::encrypt($armado->id)) }}" id="cotizacionArmadoDestroy{{ $armado->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$armado->id", 'onclick' => "return check('btnsub$armado->id', 'cotizacionArmadoDestroy$armado->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $armado->id ($armado->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>
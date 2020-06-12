<td width="1rem" title="Editar: {{ $soporte->sol }}">
  <a href="{{ route('soporte.edit', Crypt::encrypt($soporte->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
</td>
<td width="1rem" title="Eliminar: {{ $soporte->sku }}">
  <form method="post" action="{{ route('soporte.destroy', Crypt::encrypt($soporte->id)) }}" id="soporteDestroy{{ $soporte->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$soporte->id", 'onclick' => "return check('btnsub$soporte->id', 'soporteDestroy$soporte->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información (Archivos). ¿Estás seguro que quieres realizar esta acción para el registro: $soporte->id ($soporte->sol) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>
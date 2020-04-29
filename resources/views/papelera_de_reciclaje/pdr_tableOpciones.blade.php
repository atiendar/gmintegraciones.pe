<td width="1rem" title="Restaurar: {{ $registro->reg }}">
  @can('papeleraDeReciclaje.restore')
    <form method="post" action="{{ route('papeleraDeReciclaje.restore', Crypt::encrypt($registro->id)) }}" id="papeleraDeReciclajeRestore{{ $registro->id }}">
    @method('GET')@csrf
    {!! Form::button('<i class="fas fa-trash-restore"></i>', ['type' => 'submit', 'class' => 'btn btn-light btn-sm', 'id' => "btnsubp$registro->id", 'onclick' => "return check('btnsubp$registro->id', 'papeleraDeReciclajeRestore$registro->id', '¡Alerta!', '¿Estás seguro quieres restaurar el registro, $registro->id ($registro->reg) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $registro->reg }}">
  @can('papeleraDeReciclaje.destroy')
    <form method="post" action="{{ route('papeleraDeReciclaje.destroy', Crypt::encrypt($registro->id)) }}" id="papeleraDeReciclajeDestroy{{ $registro->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$registro->id", 'onclick' => "return check('btnsub$registro->id', 'papeleraDeReciclajeDestroy$registro->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro permanentemente, $registro->id ($registro->reg) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>
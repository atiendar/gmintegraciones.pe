<td width="1rem" title="Editar: {{ $armado->id }}">
  @if($armado->estat == config('app.productos_completos') OR $armado->estat == config('app.en_produccion'))
    @can('produccion.pedidoActivo.armado.edit')
      <a href="{{ route('produccion.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
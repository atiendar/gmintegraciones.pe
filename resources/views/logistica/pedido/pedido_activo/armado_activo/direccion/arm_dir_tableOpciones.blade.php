<td width="1rem" title="Editar: {{ $direccion->est }}">
  @if($direccion->estat == config('app.pendiente') OR $direccion->estat == config('app.sin_entrega_por_falta_de_informacion') OR $direccion->estat == config('app.intento_de_entrega_fallido'))
    @can('logistica.pedidoActivoLocal.armado.edit')
      <a href="{{ route('logistica.pedidoActivoLocal.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
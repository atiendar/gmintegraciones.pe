<td width="1rem" title="Editar: {{ $armado->id }}">
  @can('almacen.pedidoActivo.armadoPedidoActivo.edit')
   <a href="{{ route('almacen.pedidoActivo.armadoPedidoActivo.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
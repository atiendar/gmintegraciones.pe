<td width="1rem" title="Editar: {{ $comprobante->id }}">
  @can('logistica.direccionLocal.comprobante.edit')
    <a href="{{ route('logistica.direccionLocal.comprobante.edit', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
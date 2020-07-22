<td width="1rem" title="Editar: {{ $comprobante->id }}">
  @can('logistica.direccionLocal.comprobanteDeSalida.edit')
    <a href="{{ route('logistica.direccionLocal.comprobanteDeSalida.edit', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Generar comprobante de entrega: {{ $comprobante->id }}">
  @can('logistica.generarComprobanteDeEntrega')
    <a href="{{ route('logistica.generarComprobanteDeEntrega', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-truck"></i></a>
  @endcan
</td>
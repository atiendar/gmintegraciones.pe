<td width="1rem" title="Editar: {{ $comprobante->id }}">
  @if($comprobante->estat != config('app.entregado'))
    @can('logistica.direccionLocal.comprobante.edit')
      <a href="{{ route('logistica.direccionLocal.comprobante.edit', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Generar comprobante de entrega: {{ $comprobante->id }}">
  @can('logistica.generarComprobanteDeEntrega')
    <a href="{{ route('logistica.generarComprobanteDeEntrega', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-truck"></i></a>
  @endcan
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $comprobante->id }}">
  @if($comprobante->estat != config('app.entregado'))
    @can('logistica.direccionLocal.comprobante.createEntrega')
      <a href="{{ route('logistica.direccionLocal.comprobante.createEntrega', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
    @endcan
  @endif
</td>
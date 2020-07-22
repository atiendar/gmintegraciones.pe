<td width="1rem" title="Generar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.entregado') AND $direccion->nom_ref_uno != null)
    @can('logistica.generarComprobanteDeEntrega')
      <a href="{{ route('logistica.generarComprobanteDeEntrega', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
  @if($direccion->estat != config('app.entregado') AND $direccion->nom_ref_uno != null)
    @can('logistica.direccionLocal.comprobante.createEntrega')
      <a href="{{ route('logistica.direccionLocal.comprobante.create', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-sign-out-alt"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.entregado') AND $direccion->nom_ref_uno != null)
    @can('logistica.direccionLocal.comprobante.createEntrega')
      <a href="{{ route('logistica.direccionLocal.comprobante.create', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
    @endcan
  @endif
</td>
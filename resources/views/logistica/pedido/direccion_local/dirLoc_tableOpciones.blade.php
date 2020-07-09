<td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionLocal.createComprobantes')
      <a href="{{ route('logistica.direccionLocal.createComprobanteDeSalida', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Generar comprobante de entrega: {{ $direccion->id }}">
  @if($direccion->estat == config('app.en_ruta'))
    <a href="{{ route('logistica.pedidoActivo.armado.direccion.generarComprobanteDeEntrega', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat == config('app.en_ruta'))
    @can('logistica.direccionLocal.createComprobantes')
      <a href="" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
    @endcan
  @endif
</td>
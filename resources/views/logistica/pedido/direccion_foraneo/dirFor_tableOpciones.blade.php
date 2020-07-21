<td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionForaneo.comprobanteDeSalida.create')
      <a href="{{ route('logistica.direccionForaneo.comprobanteDeSalida.create', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-sign-out-alt"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionForaneo.createComprobantes')
      <a href="{{ route('logistica.direccionForaneo.comprobanteEntrega.index', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
    @endcan
  @endif
</td>
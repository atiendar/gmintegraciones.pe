<td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionLocal.comprobanteDeSalida.create')
      <a href="{{ route('logistica.direccionLocal.comprobanteDeSalida.create', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-sign-out-alt"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionLocal.createComprobantes')
      <a href="" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $comprobante->est }}">
  @if($comprobante->estat != config('app.entregado'))
    @can('logistica.direccionLocal.comprobanteDeSalida.create')
      <a href="{{ route('logistica.direccionLocal.comprobanteEntrega.create', Crypt::encrypt($comprobante->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
    @endcan
  @endif
</td>
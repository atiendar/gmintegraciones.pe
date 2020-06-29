<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @if($pago->estat_pag == config('app.rechazado'))
    @canany(['pago.fPedido.edit', 'venta.pedidoActivo.pago.edit'])
      <a href="{{ route('pago.fPedido.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcanany
  @endif
</td>
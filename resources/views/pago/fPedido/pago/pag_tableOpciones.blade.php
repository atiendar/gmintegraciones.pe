<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @if($pago->estat_pag == config('app.rechazado'))
    @can('pago.fPedido.edit')
      <a href="{{ route('pago.fPedido.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
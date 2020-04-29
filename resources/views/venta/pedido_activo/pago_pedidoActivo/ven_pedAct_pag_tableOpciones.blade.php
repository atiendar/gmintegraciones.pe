<td width="1rem" title="Editar: {{ $pago->id }}">
  @can('venta.pedidoActivo.pago.edit')
    <a href="" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
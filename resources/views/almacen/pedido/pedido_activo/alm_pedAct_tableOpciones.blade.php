<td width="1rem" title="Editar: {{ $pedido->num_ped_unif }}">
 @canany(['almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armadoPedidoActivo.show', 'almacen.pedidoActivo.armadoPedidoActivo.edit'])
   <a href="{{ route('almacen.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
 @endcanany
</td>
<td width="1rem" title="Generar PDF: {{ $pedido->num_ped_unif }}">
 @can('almacen.pedidoActivo.pdf')
   <a href="{{ route('almacen.pedidoActivo.pdf', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-file-pdf"></i></a>
 @endcan
</td>
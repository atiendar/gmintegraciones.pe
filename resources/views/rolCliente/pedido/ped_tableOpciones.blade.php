<td width="1rem" title="Detallar pedido: {{ $pedido->num_pedido }}">
  @if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado'))
  @else
    <a href="{{ route('rolCliente.pedido.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-info'><i class="far fa-clipboard"></i></a>
  @endif
</td>
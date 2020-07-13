<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($direcciones_locales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.armado')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.colonia')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($direcciones_locales as $direccion)
          @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
            <tr title="{{ $direccion->est }}">
          @else
            <tr title="{{ $direccion->est }}" class="text-muted cursor-allowed">
          @endif
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.armado', ['show' => true, 'canany' => ['logistica.pedidoActivo.armado.show'], 'ruta' => 'logistica.pedidoActivo.armado.show', 'target' => 'target="_blank"'])
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => true, 'canany' => ['logistica.direccionLocal.show'], 'ruta' => 'logistica.direccionLocal.show', 'target' => null])
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.colonia')
            @include('logistica.pedido.direccion_local.dirLoc_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

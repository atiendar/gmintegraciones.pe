<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($direcciones_entregadas) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else 
        <thead>
          <tr>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.armado')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.delegacionOMunicipio')
          </tr>
        </thead>
        <tbody> 
          @foreach($direcciones_entregadas as $direccion)
            <tr title="{{ $direccion->est }}">
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.armado', ['show' => true, 'canany' => ['logistica.pedidoEntregado.armado.show'], 'ruta' => 'logistica.pedidoEntregado.armado.show', 'target' => 'target="_blank"'])
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.fechaDeEntrega')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => true, 'canany' => ['logistica.pedidoEntregado.show'], 'ruta' => 'logistica.direccionEntregada.show', 'target' => null])
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.delegacionOMunicipio')
            </tr>
          @endforeach
        </tbody>
      @endif
    </table>
  </div>
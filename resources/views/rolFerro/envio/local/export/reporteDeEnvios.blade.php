<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
	<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
		@if(sizeof($envios) == 0)
			@include('layouts.private.busquedaSinResultados')
		@else 
			<thead>
				<tr>
					<th>{{ __('RUTA') }}</th>
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.fechaDeEntrega')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
					@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntregaLogistica')
					@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.delegacionOMunicipio')
	
				</tr>
			</thead>
			<tbody> 
				@foreach($envios as $direccion)
				
						<tr>
         
            <td width="1rem">{{ $direccion->rut }}</td>
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.fechaDeEntrega')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
						@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => false])
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntregaLogistica')
						@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.delegacionOMunicipio')
						
					</tr>
				@endforeach
			</tbody>
		@endif
	</table>
</div>
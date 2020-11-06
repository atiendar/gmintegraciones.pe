<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
	<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
		@if(sizeof($envios) == 0)
			@include('layouts.private.busquedaSinResultados')
		@else 
			<thead>
				<tr>
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.fechaDeEntrega')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
					@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
					@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
					@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.delegacionOMunicipio')
					<th colspan="4">&nbsp</th>
				</tr>
			</thead>
			<tbody> 
				@foreach($envios as $direccion)
					@if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
						<tr title="{{ $direccion->est }}">
					@else
						<tr title="{{ $direccion->est }}" class="text-muted cursor-allowed" style="background:#bcbcbc">
					@endif
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.fechaDeEntrega')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
						@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => false])
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
						@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
						@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.delegacionOMunicipio')
					</tr>
				@endforeach
			</tbody>
		@endif
	</table>
</div>
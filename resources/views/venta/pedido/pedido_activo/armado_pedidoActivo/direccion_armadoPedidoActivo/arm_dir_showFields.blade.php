@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.created')
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.cantidad')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatus', ['armado' => $direccion])
</div>
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.infoExtra')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.envioAlQueSeCotizo')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.metodoDeEntregaLogistica')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.comprobantes')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.infoDeEntrega')

<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{  route('venta.pedidoActivo.armado.show', Crypt::encrypt($direccion->pedido_armado_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el armado') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoArmadoDirecionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.created')
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatus')
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.codigo')
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.gama')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.regalo')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.cantidad')
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.tipo')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.nombreDeArmado')
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.sku')
</div>
@include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.productosArmado')
<div class="row">
  <div class="col-md-7">
    <div class="pad">
      @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.medidas')    
    </div>
  </div>
@include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.tarjetaDisenada')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.tipoDetarjetaDeFelicitacion')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.mensajeDedicatoria')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.ComentariosCliente')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.ComentariosVentas')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.comentariosAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.comentariosProduccion')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('almacen.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="pad">
      @include('venta.pedido_activo.ven_pedAct_showFields.created')
      <div class="row">
        @include('venta.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado')
      </div>      
      <div class="row">
        @include('venta.pedido_activo.ven_pedAct_showFields.cliente')
        @include('venta.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
      </div>
    </div>
  </div>
  @include('venta.pedido_activo.ven_pedAct_showFields.cotizacionFinalDelCliente')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.entregaExpress')
  @include('venta.pedido_activo.ven_pedAct_showFields.sePuedeEntregarAntes')
  @include('venta.pedido_activo.ven_pedAct_showFields.cuantosDiasAntes')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusFactura')
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusProduccion')
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusLogistica')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosCliente')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosVenta')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosProduccion')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosLogistica')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('venta.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection
{{-- 
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.cliente')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosCliente')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosLogistica')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosProduccion')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.comentariosVenta')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.cotizacionFinalDelCliente')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.created')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.cuantosDiasAntes')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.entregaExpress')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusFactura')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusLogistica')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusPago')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusProduccion')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.estatusVentas')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.liderDePedidoAlmacen')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.liderDePedidoLogistica')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.liderDePedidoProduccion')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.numeroDePedido')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.sePuedeEntregarAntes')
</div>
<div class="row">
  @include('venta.pedido_activo.ven_pedAct_showFields.totalDeArmados')
</div>
--}}
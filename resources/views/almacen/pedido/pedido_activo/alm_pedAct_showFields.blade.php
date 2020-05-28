 @include('venta.pedido.pedido_activo.ven_pedAct_showFields.created')
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cliente')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entregaExpress')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.sePuedeEntregarAntes')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cuantosDiasAntes')
</div>  
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacen')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccion')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosCliente')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosVenta')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosAlmacen')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosProduccion')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('almacen.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection
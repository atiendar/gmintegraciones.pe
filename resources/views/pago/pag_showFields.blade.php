@include('pago.pag_showFields.created')
<div class="row">
  @include('pago.pag_showFields.numeroDePedido')
</div>
<div class="row">
  @include('pago.pag_showFields.codigoDeFacturacion')
  @include('pago.pag_showFields.estatusPago')
</div>
<div class="row">
  @include('pago.pag_showFields.formaDePago')
  @include('pago.pag_showFields.montoDePago')
</div>
@include('pago.pag_showFields.comentarios')
@include('pago.pag_showFields.archivos_comPago_copIdentificacion')
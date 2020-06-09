<label for="redes_sociales">{{ __('INFORMACIÓN DEL PEDIDO') }}</label>
<div class="border border-primary rounded p-2">



</div>
<div class="row">
  @include('pago.pag_editFields.estatusPago')
</div>
@include('pago.pag_editFields.comentarios')
@include('pago.pag_editFields.comprobanteDePagoArchivo')
@include('layouts.private.plugins.priv_plu_select2')
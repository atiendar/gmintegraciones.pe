@include('factura.fac_showFields.created')


<div class="row">
  @include('factura.fac_showFields.estatusFactura')
  @include('factura.fac_showFields.cliente')
</div>

<div class="row">
  @include('factura.fac_showFields.nombreORazonSocial')
  @include('factura.fac_showFields.rfc')
</div>




@include('factura.fac_showFields.datosFiscales')



@include('factura.fac_showFields.datosFactura')
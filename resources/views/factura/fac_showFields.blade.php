@include('factura.fac_showFields.created')
@include('factura.fac_showFields.documentosFactura')
@include('factura.fac_showFields.informacionDelPago')
<div class="row">
  @include('factura.fac_showFields.estatusFactura')
  @include('factura.fac_showFields.cliente')
</div>
@include('factura.fac_showFields.comentariosCliente')
@include('factura.fac_showFields.comentariosAdministrador')
@include('factura.fac_showFields.datosFiscales')
@include('factura.fac_showFields.datosFactura')
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('factura.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($facturas) == 0)
      <th>Sin resultados</th>
    @else 
      <thead>
        <tr>
          @include('factura.fac_table.th.id')
          @include('factura.fac_table.th.estatusFactura')
          @include('pago.pag_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('factura.fac_table.th.cliente')
          @include('factura.fac_table.th.rfc')
          @include('factura.fac_table.th.nombreORazonSocial')
          @include('factura.fac_table.th.documentosFactura')
        </tr>
      </thead>
      <tbody> 
        @foreach($facturas as $factura)
          <tr title="{{ $factura->rfc }}">
            @include('factura.fac_table.td.id', ['show' => false])
            @include('factura.fac_table.td.estatusFactura')
            @include('pago.pag_table.td.estatusPago', ['pago' => $factura->pago])
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedido', ['pedido' => $factura->pago->pedido])
            @include('factura.fac_table.td.cliente')
            @include('factura.fac_table.td.rfc')
            @include('factura.fac_table.td.nombreORazonSocial')
            @include('factura.fac_table.td.documentosFactura')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
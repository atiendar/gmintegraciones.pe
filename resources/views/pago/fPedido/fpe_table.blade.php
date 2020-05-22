<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('venta.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('venta.pedido_activo.ven_pedAct_table.th.estatusPago')
          @include('venta.pedido_activo.ven_pedAct_table.th.montoTotal')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          <tr title="{{ $pedido->num_pedido }}">
            @include('venta.pedido_activo.ven_pedAct_table.td.numeroDePedido')
            @include('venta.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido_activo.ven_pedAct_table.td.montoTotal')
            @include('pago.fPedido.fpe_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
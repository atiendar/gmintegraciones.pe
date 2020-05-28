<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($pedidos) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else 
        <thead>
          <tr> 
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusAlmacen')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
            <th colspan="2">&nbsp</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($pedidos as $pedido)
            <tr title="{{ $pedido->serie.$pedido->id }}">
              @include('almacen.pedido.pedido_activo.alm_pedAct_tableOpcionShow')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusAlmacen')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
              @if(Request::route()->getName() == 'almacen.pedidoActivo.index')
              @include('almacen.pedido.pedido_activo.alm_pedAct_tableOpciones')
              @else
              <td></td>
             @endif
            </tr>
          @endforeach
        </tbody>
      @endif
    </table>
</div>
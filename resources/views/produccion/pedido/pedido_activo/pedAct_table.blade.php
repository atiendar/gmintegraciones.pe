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
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusProduccion')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          @if($pedido->estat_produc == config('app.asignar_lider_de_pedido') OR $pedido->estat_produc == config('app.en_espera_de_almacen') OR $pedido->estat_produc == config('app.productos_completos') OR $pedido->estat_produc == config('app.en_produccion'))
            <tr title="{{ $pedido->num_pedido }}">
          @else
            <tr title="{{ $pedido->num_pedido }}" class="text-muted cursor-allowed" style="background:#bcbcbc">
          @endif
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['produccion.pedidoActivo.show', 'produccion.pedidoActivo.armado.show'], 'ruta' => route('produccion.pedidoActivo.show',  Crypt::encrypt($pedido->id))])
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusProduccion')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
            @if($pedido->estat_produc == config('app.asignar_lider_de_pedido') OR $pedido->estat_produc == config('app.en_espera_de_almacen') OR $pedido->estat_produc == config('app.productos_completos') OR $pedido->estat_produc == config('app.en_produccion'))
              @include('produccion.pedido.pedido_activo.pedAct_tableOpciones')
            @else
              <td></td>
              <td></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
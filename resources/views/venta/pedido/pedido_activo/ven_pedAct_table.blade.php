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
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusVentas')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
@php
   $estilos = null;
   $clase = null; 
@endphp

       



          @if($pedido->estat_alm == config('app.asignar_persona_que_recibe') OR $pedido->estat_alm == config('app.en_espera_de_ventas') OR $pedido->estat_alm == config('app.en_espera_de_compra') OR $pedido->estat_alm == config('app.en_revision_de_productos'))
          @else
            @php
              $estilos = 'background:#bcbcbc;';
              $clase = 'ext-muted cursor-allowed'; 
          @endphp

       
          @endif


          <tr title="{{ $pedido->num_pedido }}" class="{{ $clase }}" style="{{ $estilos }}">
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['venta.pedidoActivo.show', 'venta.pedidoActivo.armado.show', 'venta.pedidoActivo.pago.show'], 'ruta' => route('venta.pedidoActivo.show', Crypt::encrypt($pedido->id))])
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusVentas')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
            @include('venta.pedido.pedido_activo.ven_pedAct_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
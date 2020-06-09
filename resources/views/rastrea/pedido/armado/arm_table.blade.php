<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr >
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.regalo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.autorizado')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipoDeTarjeta')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.direcciones')
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title="{{ $armado->cod }}">
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => false])
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.regalo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.autorizado')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipoDeTarjeta')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.direcciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
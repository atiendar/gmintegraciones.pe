<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @if($pedido->lid_de_ped_log == null)
        @include('layouts.private.busquedaSinResultados', ['mensaje' => __('Falta asignar líder de pedido')])
      @else
        @include('layouts.private.busquedaSinResultados')
      @endif
    @else 
    <thead>
      <tr>
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.ubicacionRack')
        <th colspan="3">&nbsp</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($armados as $armado)
      @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_ruta') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
        <tr title="{{ $armado->cod }}">
      @else
        <tr title="{{ $armado->cod }}" class="text-muted cursor-allowed">
      @endif
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => $canany_show, 'ruta' => $ruta_show])
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.ubicacionRack')
        @if(Request::route()->getName() == 'logistica.pedidoActivoLocal.edit')
          @include($ruta_opciones)
        @else
          <td></td>
        @endif
      </tr>
      @endforeach
    </tbody>
    @endif
  </table>
</div>
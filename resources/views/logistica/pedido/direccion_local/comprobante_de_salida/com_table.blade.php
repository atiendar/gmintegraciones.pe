<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($comprobantes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
    <thead>
      <tr>
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.#')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.cantidad')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.estatus')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.metodo_de_entrega')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.comprobanteDeSalida')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.comprobanteDeEntrega')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.comprobanteCostoDeEnvio')
        @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.th.costoDeEnvio')
        <th colspan="1">&nbsp</th>
      </tr>
    </thead>
      <tbody> 
        @foreach($comprobantes as $comprobante)
          <tr title="{{ $comprobante->id }}">
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.#', ['show' => true, 'canany' => ['logistica.direccionLocal.comprobante.show'], 'ruta' => 'logistica.direccionLocal.comprobante.show', 'target' => null])
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.cantidad')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.estatus')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.metodo_de_entrega')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.comprobanteDeSalida')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.comprobanteDeEntrega')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.comprobanteCostoDeEnvio')
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante.com_table.td.costoDeEnvio')
            @if(Request::route()->getName() == 'logistica.direccionLocal.comprobanteDeSalida.create')
              @include('logistica.pedido.direccion_local.comprobante_de_salida.com_tableOpciones')
            @else
              <td></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

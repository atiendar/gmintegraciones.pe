<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($comprobantes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
    <thead>
      <tr>
        <th>{{ __('#') }}</th>
        <th>{{ __('CANT.') }}</th>
        <th>{{ __('ESTATUS') }}</th>
        <th>{{ __('MET DE ENTREGA') }}</th>
        <th>{{ __('COM. SALIDA') }}</th>
        <th>{{ __('COM. ENTREGA') }}</th>
        <th>{{ __('COM. COST. ENVÍO') }}</th>
        <th>{{ __('COST. DE ENVÍO') }}</th>
        <th colspan="1">&nbsp</th>
      </tr>
    </thead>
      <tbody> 
        @foreach($comprobantes as $comprobante)
          <tr title="{{ $comprobante->id }}">
            <td>{{ $comprobante->id }}</td>
            <td>{{ Sistema::dosDecimales($comprobante->cant) }}</td>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus', ['armado' => $comprobante])
            <td>{{ $comprobante->met_de_entreg_de_log }}</td>
            <td>
              <a href="{{ Storage::url($comprobante->comp_de_sal_rut.$comprobante->comp_de_sal_nom) }}" download>{{ $comprobante->comp_de_sal_nom }}</a>
            </td>
            <td>
              <a href="{{ Storage::url($comprobante->comp_ent_rut.$comprobante->comp_ent_nom) }}" download>{{ $comprobante->comp_ent_nom }}</a>
            </td>
            <td>
              <a href="{{ Storage::url($comprobante->comp_cost_por_env_log_rut.$comprobante->comp_cost_por_env_log_nom) }}" download>{{ $comprobante->comp_cost_por_env_log_nom }}</a>
            </td>
            <td>{{ $comprobante->cost_por_env_log }}</td>
            @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante_de_entrega.comEnt_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

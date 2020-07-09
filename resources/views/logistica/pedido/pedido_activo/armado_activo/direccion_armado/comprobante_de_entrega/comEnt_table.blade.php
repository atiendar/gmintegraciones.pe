<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($comprobantes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
    <thead>
      <tr>
        <th>{{ __('CANT.') }}</th>
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
            <td>{{ $direccion->cant }}</td>
            <td>{{ $direccion->comp_de_sal_nom }}</td>
            <td>{{ $direccion->comp_ent_nom }}</td>
            <td>{{ $direccion->comp_cost_por_env_log_nom }}</td>
            <td>{{ $direccion->cost_por_env_log }}</td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

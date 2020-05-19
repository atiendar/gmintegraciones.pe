<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pagos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('pago.pag_table.th.numeroDePedido')
          <th>{{ __('EST. PAGO') }}</th>
          <th>{{ __('MONT. TOTAL') }}</th>
          <th colspan="3">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pagos as $pago)
          <tr title="{{ $pago->pedido->num_pedido }}">

            

            @include('pago.pag_table.td.numeroDePedido')
            <td>{{ $pago->pedido->estat_pag  }}</td>
            <td>{{ $pago->pedido->mont_tot_de_ped  }}</td>

          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
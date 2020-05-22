<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($productos) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else 
        <thead>
          <tr> 
            <th>{{ __('ID') }}</th>
            <th>{{ __('SKU') }}</th>
            <th>{{ __('CANTIDAD') }}</th>
            <th>{{ __('PRODUCTO') }}</th>
            <th colspan="2">&nbsp</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($productos as $productos)
            <tr title="{{ $productos->sku }}">
              <td width="1rem">{{ $productos->id }}</td>
              <td>{{ $productos->sku }}</td>
              <td>{{ $productos->cant }}</td>
              <td>{{ $productos->produc }}</td>
              @include('almacen.pedido_activo.armado_activo.productos_armado.alm_pedAct_armAct_proAct_tableOpciones')
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
</div>
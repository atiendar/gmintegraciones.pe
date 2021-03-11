<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($materiales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('SKU') }}</th>
          <th>{{ __('DESC EN INGLES') }}</th>
          <th>{{ __('PRECIO CLIENTE') }}</th>
          <th>{{ __('DESC') }}</th>
          <th>{{ __('PEC. LISTA PAGINA') }}</th>
          <th>{{ __('PROV') }}</th>
          <th>{{ __('LIN. PRODUCTO') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($materiales as $material)
          <tr title="{{ $material->sku }}">
            <td>
              @can('material.show')
                <a href="{{ route('material.show', Crypt::encrypt($material->id)) }}" title="Detalles: {{ $material->sku }}">{{ $material->sku }}</a>
              @else
                {{ $material->sku }}
              @endcan
            </td>
            <td>{{ $material->des }}</td>
            <td>{{ $material->prec_pag_al_cli }}</td>
            <td>{{ $material->desc . "%"}}</td>
            <td>{{ $material->prec_list_pag }}</td>
            <td>{{ $material->lob }}</td>
            <td>{{ $material->lin_de_prod }}</td>
            @include('material.mat_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
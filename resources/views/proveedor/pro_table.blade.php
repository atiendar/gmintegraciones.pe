<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($proveedores) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('RAZON SOCIAL') }}</th>
          <th>{{ __('NOMBRE COMERCIAL') }}</th>
          <th>{{ __('NOMBRE DEL REPRESENTANTE LEGAL') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($proveedores as $proveedor)
          <tr title="{{ $proveedor->nom_comerc  }}">
            <td width="1rem">{{ $proveedor->id }}</td>
            <td>
              @can('proveedor.show')
                <a href="{{ route('proveedor.show', Crypt::encrypt($proveedor->id)) }}" title="Detalles: {{ $proveedor->nom_comerc  }}">{{ $proveedor->raz_soc }}</a>
              @else
                {{ $proveedor->raz_soc  }}
              @endcan
              <td>{{ $proveedor->nom_comerc }}</td>
              <td>{{ $proveedor->nom_rep_legal }}</td>
            </td>
            @include('proveedor.pro_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
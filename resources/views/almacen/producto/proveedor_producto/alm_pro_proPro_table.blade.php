<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
  @if(sizeof($proveedores) == 0)
    @include('layouts.private.busquedaSinResultados')
  @else 
    <thead>
      <tr> 
        <th>{{ __('ID') }}</th>
        <th>{{ __('PROVEEDOR') }}</th>
        <th>{{ __('FAB / DIST') }}</th>
        <th>{{ __('PRECIO PROVEEDOR') }}</th>
        <th>{{ __('UTILIDAD') }}</th>
        <th>{{ __('PRECIO CLIENTE') }}</th>
        <th colspan="2">&nbsp</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($proveedores as $proveedor)
        <tr title="{{ $proveedor->nom_comerc  }}">
            <td width="1rem">{{ $proveedor->id }}</td>
            <td>{{ $proveedor->nom_comerc }}</td>
            <td>{{ $proveedor->fab_distri }}</td>
            <td>{{ $proveedor->pivot->prec_prove }}</td>
            <td>
              {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $proveedor->pivot->utilid, ['class' => 'form-control form-control-sm disable' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'disabled']) !!}
            </td>
            <td>{{ $proveedor->pivot->prec_clien }}</td>
            @if(Request::route()->getName() == 'almacen.producto.edit')
              @include('almacen.producto.proveedor_producto.alm_pro_proPro_tableOpciones')
            @else
              <td></td>
              <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
  @endif
</table>
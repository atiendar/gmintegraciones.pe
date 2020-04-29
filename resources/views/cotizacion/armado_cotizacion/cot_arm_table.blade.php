<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 30em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('CANT.') }}</th>
          <th>{{ __('TIPO') }}</th>
          <th>{{ __('DESCRIPCIÓN') }}</th>
          <th>{{ __('PRECIO UNIT.') }}</th>
          <th>{{ __('IMPORTE') }}</th>

          <th>{{ __('SUBTOTAL') }}</th>
          <th>{{ __('DESCUENTO') }}</th>
          <th>{{ __('SUBTOTAL DESC.') }}</th>
          <th>{{ __('IVA') }}</th>
          <th>{{ __('TOTAL') }}</th>



          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title="{{ $armado->nom }}">
            <td width="1rem">{{ $armado->id }}</td>
            <td>
              {!! Form::open(['route' => ['cotizacion.armado.editCantidad', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'arconProductoEditCantidad']) !!}
                {!! Form::select('cantidad', config('opcionesSelect.select_cantidad_table_productos_edit'), $armado->cant, ['class' => 'form-control form-control-sm w-75' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
              {!! Form::close() !!}
            </td>
            <td>{{ $armado->tip }}</td>
            <td>
              <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
              @foreach($armado->productos as $producto)
                <div class="input-group text-muted ml-4">
                  {{ $producto->cant }} - {{ $producto->produc }}
                  {!! Form::open(['route' => ['cotizacion.armado.editUtilidad', Crypt::encrypt($producto->id)], 'method' => 'patch', 'id' => 'arconProductoEditCantidad']) !!}
                    {!! Form::select('utilidad', config('opcionesSelect.select_utilidad_sin_seleccione'), $producto->utilid, ['class' => 'border-0 p-0' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'style' => 'pacity:1;', 'onchange' => 'this.form.submit()']) !!}
                  {!! Form::close() !!}
                </div>
              @endforeach
            </td>
            <td width="1rem">{{ $armado->prec_unit }}</td>
            <td width="1rem">{{ $armado->imp }}</td>


            <td width="1rem">{{ $armado->imp }}</td>
            <td width="1rem">{{ $armado->imp }}</td>
            <td width="1rem">{{ $armado->imp }}</td>
            <td width="1rem">{{ $armado->imp }}</td>
            <td width="1rem">{{ $armado->imp }}</td>






            @include('cotizacion.armado_cotizacion.cot_arm_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
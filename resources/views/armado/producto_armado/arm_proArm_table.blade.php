<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          @include('almacen.producto.alm_pro_table.th.id')
          <th>{{ __('CANT.') }}</th>
          @include('almacen.producto.alm_pro_table.th.sku')
          @include('almacen.producto.alm_pro_table.th.producto')
          @include('almacen.producto.alm_pro_table.th.stock')
          @include('almacen.producto.alm_pro_table.th.proveedor')
          @include('almacen.producto.alm_pro_table.th.precioProveedor')
          <th>{{ __('UTIL.') }}</th>
          @include('almacen.producto.alm_pro_table.th.precioCliente')
          @include('almacen.producto.alm_pro_table.th.categoria')
          @include('almacen.producto.alm_pro_table.th.etiqueta')
          @include('almacen.producto.alm_pro_table.th.existenciaEquivalente')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          <tr title="{{ $producto->sku }}">
            @include('almacen.producto.alm_pro_table.td.id')
            <td>
              @canany(['armado.producto.editCantidad', 'armado.clon.producto.editCantidad'])
                {!! Form::open(['route' => ['armado.producto.editCantidad', Crypt::encrypt($producto->id), Crypt::encrypt($armado->id)  ], 'method' => 'patch', 'id' => 'armadoProductoEditCantidad']) !!}
                  {!! Form::select('cantidad', config('opcionesSelect.select_cantidad_table_productos_edit'), $producto->pivot->cant, ['class' => 'form-control form-control-sm' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
                {!! Form::close() !!}
              @else
                {{ $producto->pivot->cant }}
              @endcanany
            </td>
            @include('almacen.producto.alm_pro_table.td.sku')
            @include('almacen.producto.alm_pro_table.td.producto')
            @include('almacen.producto.alm_pro_table.td.stock')
            @include('almacen.producto.alm_pro_table.td.proveedor')
            @include('almacen.producto.alm_pro_table.td.precioProveedor')
            <td>
              {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $producto->utilid, ['class' => 'form-control form-control-sm disable' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'disabled']) !!}
            </td>
            @include('almacen.producto.alm_pro_table.td.precioCliente')
            @include('almacen.producto.alm_pro_table.td.categoria')
            @include('almacen.producto.alm_pro_table.td.etiqueta')
            @include('almacen.producto.alm_pro_table.td.existenciaEquivalente')
            @if(Request::route()->getName() == 'armado.edit' OR Request::route()->getName() == 'armado.clon.edit')
              @include('armado.producto_armado.arm_proArm_tableOpciones')
            @else
              <td width="1rem"></td>
              <td width="1rem"></td>
            @endif
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
{!! Form::open(['route' => ['cotizacion.armado.producto.store', Crypt::encrypt($armado->id)], 'onsubmit' => 'return checarBotonSubmit("btnCotizacionArmadoProductoStore")', 'class' => 'col-sm-6 float-right']) !!}
  <div class="form-group row p-0 m-0">
    <label for="productos" class="col-sm-3 col-form-label">{{ __('Registrar productos') }} *</label>
    <div class="col-sm-9">
      <div class="input-group-append text-dark"> 
        {!! Form::select('id_producto', $productos_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('id_producto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
        &nbsp&nbsp&nbsp<button type="submit"  id="btnCotizacionArmadoProductoStore" class="btn btn-info rounded" title="{{ __('Registrar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_producto') }}</span>
    </div>
  </div>
{!! Form::close() !!}
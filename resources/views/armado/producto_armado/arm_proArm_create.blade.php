@canany(['armado.producto.create', 'armado.clon.producto.create'])
  @if(Request::route()->getName() == 'armado.edit' OR Request::route()->getName() == 'armado.clon.edit')
    {!! Form::open(['route' => ['armado.producto.store', Crypt::encrypt($armado->id)], 'onsubmit' => 'return checarBotonSubmit("btnArmadoProductoStore")', 'class' => 'col-sm-6 float-right']) !!}
      <div class="form-group row">
        <label for="productos" class="col-sm-3 col-form-label">{{ __('Registrar productos') }} *</label>
        <div class="col-sm-9">
          <div class="input-group-append">
            {!! Form::select('ids_productos[]', $productos_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('ids_productos') ? ' is-invalid' : ''), 'multiple']) !!}
            &nbsp&nbsp&nbsp<button type="submit" id="btnArmadoProductoStore" class="btn btn-info rounded" title="{{ __('Registrar') }}"><i class="fas fa-check-circle text-dark"></i></button>
          </div>
          <span class="text-danger">{{ $errors->first('ids_productos') }}</span>
        </div>
      </div>
    {!! Form::close() !!}
  @endif
@endcanany
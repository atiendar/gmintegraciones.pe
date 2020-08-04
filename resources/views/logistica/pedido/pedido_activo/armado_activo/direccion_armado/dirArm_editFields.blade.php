<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus">{{ __('Estatus') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus', config('opcionesSelect.select_estatus_logistica_direcciones'), $armado->estat, ['class' => 'form-control select2' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
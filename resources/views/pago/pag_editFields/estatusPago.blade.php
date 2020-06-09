<div class="form-group col-sm btn-sm">
  <label for="estatus_pago">{{ __('Estatus pago') }} *</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::select('estatus_pago', config('opcionesSelect.select_estatus_pago_individual'), $pago->estat_pag, ['class' => 'form-control select2' . ($errors->has('estatus_pago') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
  </div>
  <span class="text-danger">{{ $errors->first('estatus_pago') }}</span>
</div>
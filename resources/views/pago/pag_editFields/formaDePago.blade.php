<div class="form-group col-sm btn-sm">
  <label for="forma_de_pago">{{ __('Forma de pago') }} *</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::select('forma_de_pago', config('opcionesSelect.select_forma_de_pago'), null, ['class' => 'form-control select2' . ($errors->has('forma_de_pago') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
  </div>
  <span class="text-danger">{{ $errors->first('forma_de_pago') }}</span>
</div>
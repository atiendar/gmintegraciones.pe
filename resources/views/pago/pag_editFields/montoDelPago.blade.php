<div class="form-group col-sm btn-sm">
  <label for="monto_del_pago">{{ __('Monto del pago') }} *</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('monto_del_pago', null, ['id' => 'monto_del_pago', 'class' => 'form-control' . ($errors->has('monto_del_pago') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio proveedor'), 'onChange' => 'getMontoDelPago();']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
  <span class="text-danger">{{ $errors->first('monto_del_pago') }}</span>
</div>
<div class="form-group col-sm btn-sm">
  <label for="serie">{{ __('Serie') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('serie', $pago->serie, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Serie'), 'readonly' => 'readonly']) !!}
  </div>
</div>
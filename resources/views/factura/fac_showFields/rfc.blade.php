<div class="form-group col-sm btn-sm">
  <label for="rfc">{{ __('RFC') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
    </div>
     {!! Form::text('rfc', $factura->rfc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('RFC'), 'readonly' => 'readonly']) !!}
  </div>
</div>
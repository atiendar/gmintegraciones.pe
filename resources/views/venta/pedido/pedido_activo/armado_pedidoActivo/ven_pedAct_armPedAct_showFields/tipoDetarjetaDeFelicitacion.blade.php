<div class="form-group col-sm btn-sm">
  <label for="tipo_de_tarjeta_de_felicitacion">{{ __('Tipo de tarjeta de felicitación') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('tipo_de_tarjeta_de_felicitacion', $armado->tip_tarj_felic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de tarjeta de felicitación'), 'readonly' => 'readonly']) !!}
  </div>
</div>
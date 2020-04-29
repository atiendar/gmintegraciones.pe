<div class="form-group col-sm btn-sm">
  <label for="tipo_de_envio">{{ __('Tipo de envió') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('tipo_de_envio', $armado->tip_env, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envió'), 'readonly' => 'readonly']) !!}
  </div>
</div>
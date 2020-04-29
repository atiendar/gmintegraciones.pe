<div class="form-group col-sm btn-sm">
  <label for="numero_de_guia">{{ __('Número de guía') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('numero_de_guia', $armado->num_guia, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Número de guía'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="mensaje_de_dedicatoria">{{ __('Mensaje de dedicatoria') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('mensaje_de_dedicatoria', $armado->mens_dedic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Mensaje de dedicatoria'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
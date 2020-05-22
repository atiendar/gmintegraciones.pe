<div class="form-group col-sm btn-sm">
  <label for="metodo_de_envio_logistica">{{ __('Método de envió logística') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('metodo_de_envio_logistica', $armado->met_de_entreg_log, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de envió logística'), 'readonly' => 'readonly']) !!}
  </div>
</div>
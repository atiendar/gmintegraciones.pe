<div class="form-group col-sm btn-sm">
  <label for="costo_por_envio">{{ __('Costo por envió') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('costo_por_envio', $armado->cost_por_env_vent , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo por envió'), 'readonly' => 'readonly']) !!}
  </div>
</div>
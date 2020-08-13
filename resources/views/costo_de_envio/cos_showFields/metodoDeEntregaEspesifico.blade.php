<div class="form-group col-sm btn-sm">
  <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('metodo_de_entrega_espesifico', $costo_de_envio->met_de_entreg_esp, ['class' => 'form-control', 'placeholder' => __('Método de entrega espesifico'), 'readonly' => 'readonly']) !!}
  </div>
</div>
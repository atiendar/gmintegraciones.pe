<div class="form-group col-sm btn-sm">
  <label for="metodo_de_entrega_de_ventas">{{ __('Método de entrega de ventas') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('metodo_de_entrega_de_ventas', $armado->met_de_entreg_de_vent , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega de ventas'), 'readonly' => 'readonly']) !!}
  </div>
</div>
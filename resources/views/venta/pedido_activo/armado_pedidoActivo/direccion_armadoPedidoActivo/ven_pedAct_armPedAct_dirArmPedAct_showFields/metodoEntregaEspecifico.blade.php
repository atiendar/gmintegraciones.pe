<div class="form-group col-sm btn-sm">
  <label for="metodo_de_entrega_especifico">{{ __('Método de entrega específico') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('metodo_de_entrega_especifico', $armado->espe_el_met_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega específico'), 'readonly' => 'readonly']) !!}
  </div>
</div>
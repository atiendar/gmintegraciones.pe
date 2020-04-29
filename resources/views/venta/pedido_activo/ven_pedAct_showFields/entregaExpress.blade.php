<div class="form-group col-sm btn-sm">
  <label for="es_entrega_express">{{ __('¿Es entrega express?') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-question"></i></span>
    </div>
    {!! Form::select('es_entrega_express', config('opcionesSelect.select_entrega_express'), $pedido->entr_xprs, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
  </div>
</div>
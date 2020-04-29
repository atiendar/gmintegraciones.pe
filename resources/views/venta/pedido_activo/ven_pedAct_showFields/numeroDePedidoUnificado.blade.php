<div class="form-group col-sm btn-sm">
  <label for="numero_de_pedido_unificado">{{ __('Número(s) de pedido(s) unificado(s)') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('numero_de_pedido_unificado', $pedido->num_ped_unif, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Número(s) de pedido(s) unificado(s)'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="lider_de_pedido_logistica">{{ __('Líder de pedido logística') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('lider_de_pedido_logistica', $pedido->lid_de_ped_log, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Líder de pedido logística'), 'readonly' => 'readonly']) !!}
  </div>
</div>
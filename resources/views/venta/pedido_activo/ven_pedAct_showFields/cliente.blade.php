<div class="form-group col-sm btn-sm">
  <label for="cliente">{{ __('Cliente') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('cliente', $pedido->usuario->email_registro, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Cliente'), 'readonly' => 'readonly']) !!}
  </div>
</div>
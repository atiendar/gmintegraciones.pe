<div class="form-group col-sm btn-sm">
  <label for="lider_de_pedido_almacen">{{ __('Líder de pedido almacén') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('lider_de_pedido_almacen', $pedido->lid_de_ped_alm, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Líder de pedido almacén'), 'readonly' => 'readonly']) !!}
  </div>
</div>
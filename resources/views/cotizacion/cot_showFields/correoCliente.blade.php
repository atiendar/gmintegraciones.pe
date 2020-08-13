<div class="form-group col-sm btn-sm">
  <label for="correo_del_cliente">{{ __('Correo del cliente') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
    </div>
    {!! Form::select('correo_del_cliente', [$cotizacion->cliente->id => $cotizacion->cliente->email_registro], $cotizacion->user_id, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
  </div>
</div>
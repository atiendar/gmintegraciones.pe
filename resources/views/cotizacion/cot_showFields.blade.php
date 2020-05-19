<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
        {!! Form::text('created_at', $cotizacion->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_cot">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_cot', $cotizacion->created_at_cot, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha ultima modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
        {!! Form::text('updated_at', $cotizacion->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ultima modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_cot">{{ __('Ultima modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_cot', $cotizacion->updated_at_cot, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ultima modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="serie">{{ __('Serie') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('serie', [$cotizacion->serie => $cotizacion->serie], $cotizacion->serie, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  @include('cotizacion.cot_showFields.validez')


  <div class="form-group col-sm btn-sm">
    <label for="numeor_de_pedido_generado">{{ __('Núm. pedido generado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('numeor_de_pedido_generado', $cotizacion->num_pedido_gen, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Núm. pedido generado'), 'readonly' => 'readonly']) !!}
    </div>
  </div>


</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_del_cliente">{{ __('Correo del cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::select('correo_del_cliente', [$cotizacion->cliente->id => $cotizacion->cliente->email_registro], $cotizacion->user_id, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  @include('cotizacion.cot_showFields.estatus')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla">{{ __('Describe esta cotización para que sea mas fácil encontrarla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla', $cotizacion->desc_cot, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Describe esta cotización para que sea mas fácil encontrarla'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
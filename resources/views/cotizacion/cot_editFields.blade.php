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
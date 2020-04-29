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
  @include('cotizacion.cot_showValidez')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_del_cliente">{{ __('Correo del cliente') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::select('correo_del_cliente', $clientes_list, $cotizacion->email_cliente, ['class' => 'form-control select2' . ($errors->has('correo_del_cliente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('correo_del_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'cotizacionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
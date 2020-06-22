<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_adicionales">{{ __('Comentarios adicionales') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios_adicionales', null, ['class' => 'form-control' . ($errors->has('comentarios_adicionales') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios adicionales'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios_adicionales') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($armado->pedido_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
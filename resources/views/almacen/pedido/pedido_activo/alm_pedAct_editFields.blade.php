<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="lider_de_pedido_almacen">{{ __('Líder de pedido almacén') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('lider_de_pedido_almacen', $pedido->lid_de_ped_alm, ['class' => 'form-control' . ($errors->has('lider_de_pedido_almacen') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Líder de pedido almacén')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lider_de_pedido_almacen') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_almacen">{{ __('Comentario almacén') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_almacen', $pedido->coment_alm, ['class' => 'form-control' . ($errors->has('comentario_almacen') ? ' is-invalid' : ''), 'maxlength' => 65500, 'placeholder' => __('Comentario almacén'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_almacen') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('almacen.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'almacenPedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar pedido') }}</button>
  </div>
</div>
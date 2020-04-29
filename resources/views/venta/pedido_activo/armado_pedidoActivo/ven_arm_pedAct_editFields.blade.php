<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus_armado">{{ __('Estatus armado') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus_armado', config('opcionesSelect.select_estatus_armado'), $armado->estat_arc, ['class' => 'form-control select2' . ($errors->has('estatus_armado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus_armado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_almacen_armado">{{ __('Comentarios almacen armado:') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_almacen_armado', $armado->coment_alm, ['class' => 'form-control' . ($errors->has('comentario_almacen_armado') ? ' is-invalid' : ''), 'maxlength' => 65500, 'placeholder' => __('Comentarios almacen armado:'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_almacen_armado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($armado->pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'armadoPedidoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
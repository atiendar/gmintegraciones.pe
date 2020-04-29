<div class="row">
  <div class="col-md-7">
    <div class="pad">
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="fecha_de_entrega">{{ __('Fecha de entrega') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></i></span>
            </div>
            {!! Form::date('fecha_de_entrega', $pedido->fech_de_entreg, ['class' => 'form-control', 'min' =>  date('Y-m-d')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('fecha_de_entrega') }}</span>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="cotizacion_final_del_cliente">{{ __('Cotización final del cliente') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
            </div>
            <div class="custom-file"> 
              {!! Form::file('cotizacion_final_del_cliente', ['class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,application/pdf', 'lang' => Auth::user()->lang]) !!}
              <label class="custom-file-label" for="archivo">Max. 1MB</label>
            </div>
            <a href="https://www.ilovepdf.com/es/comprimir_pdf/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
          </div>
          <span class="text-danger">{{ $errors->first('cotizacion_final_del_cliente') }}</span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="se_puede_entregar_antes">{{ __('¿Se puede entregar antes?') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-question"></i></span>
            </div>
            {!! Form::select('se_puede_entregar_antes', config('opcionesSelect.select_se_puede_entregar_antes'), $pedido->se_pued_entreg_ant, ['class' => 'form-control select2' . ($errors->has('se_puede_entregar_antes') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('se_puede_entregar_antes') }}</span>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="cuantos_dias_antes">{{ __('¿Cuántos días antes?') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-question"></i></span>
            </div>
            {!! Form::text('cuantos_dias_antes', $pedido->cuant_dia_ant, ['class' => 'form-control' . ($errors->has('cuantos_dias_antes') ? ' is-invalid' : ''),  'maxlength' => 3, 'placeholder' => __('¿Cuántos días antes?')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('cuantos_dias_antes') }}</span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="comentarios_ventas">{{ __('Comentarios ventas') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::textarea('comentarios_ventas', $pedido->coment_vent, ['class' => 'form-control' . ($errors->has('comentarios_ventas') ? ' is-invalid' : ''), 'maxlength' => 65500, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('comentarios_ventas') }}</span>
        </div>
      </div>
    </div>
  </div>
  @include('venta.pedido_activo.ven_pedAct_showFields.cotizacionFinalDelCliente')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('venta.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
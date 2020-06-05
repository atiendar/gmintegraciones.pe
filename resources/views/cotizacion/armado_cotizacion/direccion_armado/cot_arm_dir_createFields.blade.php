<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('cantidad', null, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', config('opcionesSelect.select_metodo_de_entrega'), null, ['v-on:change' => 'getCostos', 'v-model' => 'metodo_de_entrega', 'class' => 'form-control select2' . ($errors->has('metodo_de_entrega') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('metodo_de_entrega') }}</span>
  </div> 
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estado_al_que_se_cotizo">{{ __('Estado al que se cotizo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('estado_al_que_se_cotizo', config('opcionesSelect.select_estado'), null, ['v-on:change' => 'getCostos', 'v-model' => 'estado_al_que_se_cotizo', 'class' => 'form-control select2' . ($errors->has('estado_al_que_se_cotizo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('estado_al_que_se_cotizo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('detalles_de_la_ubicacion', null, ['class' => 'form-control' . ($errors->has('detalles_de_la_ubicacion') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Detalles de la ubicación')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('detalles_de_la_ubicacion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_envio', config('opcionesSelect.select_tipo_de_envio'), 'Normal', ['v-on:change' => 'getCostos', 'v-model' => 'tipo_de_envio', 'class' => 'form-control select2' . ($errors->has('tipo_de_envio') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_envio') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="costo_de_envio">{{ __('Costo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('costo_de_envio', null, ['v-model' => 'costo_de_envio', 'id' => 'costo_de_envio', 'class' => 'form-control' . ($errors->has('costo_de_envio') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Costo de envío')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('costo_de_envio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('cotizacion.armado.edit', Crypt::encrypt($armado->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el armado') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar dirección') }}</button>
  </div>
</div>
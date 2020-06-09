<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', config('opcionesSelect.select_metodo_de_entrega'), null, ['class' => 'form-control select2' . ($errors->has('metodo_de_entrega') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('metodo_de_entrega') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="estado">{{ __('Estado') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('estado', config('opcionesSelect.select_estado'), null, ['class' => 'form-control select2' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="foraneo_o_local">{{ __('Foráneo o local') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('foraneo_o_local', config('opcionesSelect.select_foraneo_local'), null, ['class' => 'form-control select2' . ($errors->has('foraneo_o_local') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('foraneo_o_local') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_envio', config('opcionesSelect.select_tipo_de_envio'), null, ['class' => 'form-control select2' . ($errors->has('tipo_de_envio') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_envio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('costo_por_envio', null, ['id' => 'costo_por_envio', 'class' => 'form-control' . ($errors->has('costo_por_envio') ? ' is-invalid' : ''), 'placeholder' => __('Costo por envío'), 'onChange' => 'getDecimal();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('costo_por_envio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('costoDeEnvio.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('costo_de_envio.cos_getDecimal')
<label for="redes_sociales">{{ __('INFORMACIÓN EXTRA DEL ARMADO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="tipo_de_tarjeta_de_felicitacion">{{ __('Tipo de tarjeta de felicitación') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-list"></i></span>
        </div>
        {!! Form::select('tipo_de_tarjeta_de_felicitacion', [], null, ['id' => 'tipo_de_tarjeta_de_felicitacion', 'class' => 'form-control select2' . ($errors->has('tipo_de_tarjeta_de_felicitacion') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipoTarjetaDeFelicitacion();']) !!}
      </div>
      <span class="text-danger">{{ $errors->first('tipo_de_tarjeta_de_felicitacion') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="tarjeta_diseñada_por_el_cliente">{{ __('Tarjeta diseñada por el cliente') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('tarjeta_diseñada_por_el_cliente', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('tarjeta_diseñada_por_el_cliente') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="mensaje_de_dedicatoria">{{ __('Mensaje de dedicatoria') }} <strong>{{ __('Se plasmará tal y como se escriba en este campo') }}</strong></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('mensaje_de_dedicatoria', null, ['class' => 'form-control' . ($errors->has('mensaje_de_dedicatoria') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Mensaje de dedicatoria'), 'rows' => 4, 'cols' => 4]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('mensaje_de_dedicatoria') }}</span>
    </div>
  </div>
</div>
  <label for="redes_sociales">{{ __('DATOS DIRECCIÓN DE ENTREGA') }}</label>
<div class="border border-primary rounded p-2">
  @include('rolCliente.direccion.dir_createFields')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($armado->pedido_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="serie">{{ __('Serie') }} *</label>
    @can('sistema.serie.create')
      <a href="{{ route('sistema.serie.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar serie') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('serie', $series_list, null, ['class' => 'form-control select2' . ($errors->has('serie') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('serie') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cliente">{{ __('Cliente') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::select('cliente', $clientes_list, null, ['class' => 'form-control select2' . ($errors->has('cliente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="total_de_armados">{{ __('Total de armados') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('total_de_armados', null, ['class' => 'form-control' . ($errors->has('total_de_armados') ? ' is-invalid' : ''), 'maxlength' => 11, 'placeholder' => __('Total de armados')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('total_de_armados') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="monto_total">{{ __('Monto total (Con IVA y envió)') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('monto_total', null, ['id' => 'monto_total', 'class' => 'form-control' . ($errors->has('monto_total') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Monto total (Con IVA y envió)'), 'onChange' => 'decimal();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('monto_total') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="es_entrega_express">{{ __('¿Es entrega express?') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('es_entrega_express', config('opcionesSelect.select_entrega_express'), null, ['class' => 'form-control select2' . ($errors->has('es_entrega_express') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_entrega_express') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="es_pedido_urgente">{{ __('¿Es pedido urgente?') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('es_pedido_urgente', config('opcionesSelect.es_pedido_urgente'), null, ['class' => 'form-control select2' . ($errors->has('es_pedido_urgente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_pedido_urgente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="plantilla">{{ __('Plantilla') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-brush"></i></span>
      </div>
      {!! Form::select('plantilla', $plantillas, $plantilla_default, ['class' => 'form-control select2' . ($errors->has('plantilla') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('plantilla') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="checkbox_correo"></label>
    <div class="input-group p-2">
      <div class="custom-control custom-switch">
        {!! Form::checkbox('checkbox_correo', 'on', true, ['id' => 'checkbox_correo', 'class' => 'custom-control-input' . ($errors->has('checkbox_correo') ? ' is-invalid' : '')]) !!}
        <label class="custom-control-label" for="checkbox_correo">{{ __('Enviar correo') }}</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('checkbox_correo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('venta.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js6')
<script>
  function decimal() {
    // Obtiene los valores de los inputs
    monto_total = document.getElementById("monto_total"),
    monto_total = monto_total.value;
    // ---

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(monto_total))) {
      monto_total = 0;
    }

    // Agrega o solo deja dos decimales
    monto_total   = Number.parseFloat(monto_total).toFixed(2);
    // ---
  
    // Pega el resultado en los inputs
    document.getElementById("monto_total").value = monto_total;
  }
</script>
@endsection
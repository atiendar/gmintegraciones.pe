@include('armado.arm_showFields.medidas')
<div class="row">
  @include('armado.arm_showFields.tipo')
  <div class="form-group col-sm btn-sm">
    <label for="descripcion">{{ __('Descripción') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('descripcion', $armado->nom.' ('.$armado->sku.')', ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Descripción'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="es_de_regalo">{{ __('¿Es de regalo?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('es_de_regalo', config('opcionesSelect.select_si_no'), $armado->es_de_regalo, ['class' => 'form-control select2' . ($errors->has('es_de_regalo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_de_regalo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('cantidad', $armado->cant, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_unitario">{{ __('Precio unitario') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_unitario', Sistema::dosDecimales($armado->prec_redond), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio unitario'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Tipo de descuento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_descuento', config('opcionesSelect.select_tipo_de_descuento'), $armado->tip_desc, ['id' => 'tipo_de_descuento', 'class' => 'form-control select2' . ($errors->has('tipo_de_descuento') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipoDeEnvio();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_descuento') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_manual">
    <label for="manual">{{ __('Manual') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('manual', $armado->manu, ['id' => 'manual', 'class' => 'form-control' . ($errors->has('manual') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Manual'), 'onChange' => 'getManualDecimal();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('manual') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_porcentaje">
    <label for="porcentaje">{{ __('Porcenjate') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
      </div>
      {!! Form::select('porcentaje', config('opcionesSelect.select_utilidad_sin_seleccione'), $armado->porc, ['id' => 'porcentaje', 'class' => 'form-control select2' . ($errors->has('porcentaje') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('porcentaje') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Descuento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('descuento', Sistema::dosDecimales($armado->desc), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Descuento'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="costo_de_envio">{{ __('Costo de envío') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('costo_de_envio', Sistema::dosDecimales($armado->cost_env), ['id' => 'costo_de_envio', 'class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="subtotal">{{ __('Subtotal') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('subtotal', Sistema::dosDecimales($armado->sub_total), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Subtotal'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="iva">{{ __('IVA') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('iva', Sistema::dosDecimales($armado->iva), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('IVA'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="total">{{ __('Total') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('total', Sistema::dosDecimales($armado->tot), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Total'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('cotizacion.edit', Crypt::encrypt($armado->cotizacion->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con la cotización') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'cotizacionArmadoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
  </div>
</div>
@section('js6')
<script>
  window.onload = function() { 
    getTipoDeEnvio();
  }
  function getTipoDeEnvio() {var
    select_tipo_de_descuento = document.getElementById("tipo_de_descuento"),
    tipo_de_descuento = select_tipo_de_descuento.value;
    opc_manual = document.getElementById('opc_manual');
    opc_porcentaje = document.getElementById('opc_porcentaje');
  
    if(tipo_de_descuento == 'Sin descuento') {
      opc_manual.style.display = 'none';
      opc_porcentaje.style.display = 'none';
    }
    if(tipo_de_descuento == 'Manual') {
      opc_manual.style.display = 'block';
      opc_porcentaje.style.display = 'none';
      getManualDecimal();
    }
    if(tipo_de_descuento == 'Porcentaje') {
      opc_porcentaje.style.display = 'block';
      opc_manual.style.display = 'none';
    }
  }
  function getManualDecimal() {
    // Obtiene los valores de los inputs
    manual = document.getElementById("manual").value;
   
    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(manual))) {
      manual = 0;
    }

    // Agrega o solo deja dos decimales
    manual_decimal  = Number.parseFloat(manual).toFixed(2);
    document.getElementById("manual").value = manual_decimal;
  }
  function getCostoDeEnvioDecimal() {
    // Obtiene los valores de los inputs
    costo_de_envio = document.getElementById("costo_de_envio").value;
   
    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(costo_de_envio))) {
      costo_de_envio = 0;
    }

    // Agrega o solo deja dos decimales
    costo_de_envio_decimal  = Number.parseFloat(costo_de_envio).toFixed(2);
    document.getElementById("costo_de_envio").value = costo_de_envio_decimal;
  }
</script>
@endsection
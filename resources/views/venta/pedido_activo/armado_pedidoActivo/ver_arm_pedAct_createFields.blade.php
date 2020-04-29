<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="registrar_armados_por">{{ __('Registrar armados por') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('registrar_armados_por', ['Cotización' => 'Cotización', 'Manual' => 'Manual'], null, ['id' => 'registrar_armados_por', 'class' => 'form-control select2' . ($errors->has('registrar_armados_por') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getRegistrarArmadosPor();']) !!}    
    </div>
    <span class="text-danger">{{ $errors->first('registrar_armados_por') }}</span>
  </div>
</div>
<div id="manual">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="cantidad">{{ __('Cantidad') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('cantidad', null, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Cantidad')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('cantidad') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="es_de_regalo">{{ __('¿Es de regalo?') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-list"></i></span>
        </div>
        {!! Form::select('es_de_regalo', config('opcionesSelect.select_es_de_regalo'), null, ['class' => 'form-control select2' . ($errors->has('es_de_regalo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
      </div>
      <span class="text-danger">{{ $errors->first('es_de_regalo') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="armado">{{ __('Armado') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
        </div>
        {!! Form::select('armado', $armados_list, null, ['class' => 'form-control select2' . ($errors->has('armado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}    
      </div>
      <span class="text-danger">{{ $errors->first('armado') }}</span>
    </div>
  </div>
</div>
<div id="cotizacion">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="cotizacion">{{ __('Cotización') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-minus"></i></span>
        </div>
        {!! Form::select('cotizacion', $cotizaciones_list, null, ['class' => 'form-control select2' . ($errors->has('cotizacion') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}    
      </div>
      <span class="text-danger">{{ $errors->first('cotizacion') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_ventas">{{ __('Comentarios ventas') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios_ventas', null, ['class' => 'form-control' . ($errors->has('comentarios_ventas') ? ' is-invalid' : ''), 'maxlength' => 65500, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios_ventas') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')

@section('js6')
<script>
  window.onload = function() { 
    getRegistrarArmadosPor();
  }
  function getRegistrarArmadosPor() {
    // Obtiene los valores de los inputs
    registrar_armados_por = document.getElementById("registrar_armados_por"),
    registrar_armados_por = registrar_armados_por.value;

    // Muestra u oculta los campos dependiendo la selección
    if(registrar_armados_por == 'Cotización') {
      manual.style.display = 'none';
      cotizacion.style.display = 'block';
    }else if(registrar_armados_por == 'Manual') {
      manual.style.display = 'block';
      cotizacion.style.display = 'none';
    } else if(registrar_armados_por == '') {
      manual.style.display = 'none';
      cotizacion.style.display = 'none';
    }
    // ---
  }
</script>
@endsection
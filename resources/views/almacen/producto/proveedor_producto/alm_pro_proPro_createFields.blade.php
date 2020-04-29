<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_proveedor">{{ __('Nombre del proveedor') }} *</label>
    @can('proveedor.create')
      <a href="{{ route('proveedor.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar proveedor') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('nombre_del_proveedor', $proveedores_list, null, ['class' => 'form-control select2' . ($errors->has('nombre_del_proveedor') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_proveedor') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_proveedor">{{ __('Precio proveedor') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_proveedor', null, ['id' => 'precio_proveedor', 'class' => 'form-control' . ($errors->has('precio_proveedor') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio proveedor'), 'onChange' => 'calcularUtilidadSimple();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_proveedor') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="utilidad">{{ __('Utilidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), '.4', ['id' => 'utilidad', 'class' => 'form-control select2' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'calcularUtilidadSimple();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('utilidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_cliente">{{ __('Precio cliente') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_cliente', null, ['id' => 'precio_cliente', 'class' => 'form-control disabled' . ($errors->has('precio_cliente') ? ' is-invalid' : ''), 'placeholder' => __('Precio cliente'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('precio_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el producto') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_calcularUtilidad')
@section('js6')
<script>
  function calcularUtilidadSimple() {
    // Obtiene los valores de los inputs
    precio_proveedor = document.getElementById("precio_proveedor").value;
    selectUtilidad = document.getElementById("utilidad"),
    utilidad = selectUtilidad.value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(precio_proveedor))) {
      precio_proveedor = 0;
    }

    // Agrega o solo deja dos decimales
    precio_proveedor_decimal  = Number.parseFloat(precio_proveedor).toFixed(2);

    // Calcula la utilidad
    precio_cliente = calculaUtilidad( parseFloat(precio_proveedor_decimal), parseFloat(utilidad), parseFloat(0.00));

    precio_cliente    = Number.parseFloat(precio_cliente).toFixed(2);
    // Pega el resultado en los inputs
    document.getElementById("precio_proveedor").value = precio_proveedor_decimal;
    document.getElementById("precio_cliente").value = precio_cliente;
  }
</script>
@endsection
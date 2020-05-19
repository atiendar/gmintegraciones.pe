<div class="row">
  @can('almacen.producto.disminuirStock')
    <div class="col-sm">
      <div class="card card-info card-outline card-tabs position-relative bg-white">
        <div class="card-body">
          {!! Form::open(['route' => ['venta.pedidoActivo.updateTotalDeArmados', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoUpdateTotalDeArmados']) !!}
            <div class="form-group row">
              <label for="total_de_armados" class="col-sm-5 col-form-label">{{ __('Total de armados') }} *</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                  </div>
                  {!! Form::text('total_de_armados', $pedido->tot_de_arm, ['class' => 'form-control' . ($errors->has('total_de_armados') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('Total de armados')]) !!}
                  <button type="submit" id="btnsubmit2" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit2', 'ventaPedidoActivoUpdateTotalDeArmados', '¡Alerta!', '¿Estás seguro quieres cambiar el total de armados?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
                </div>
                <span class="text-danger">{{ $errors->first('total_de_armados') }}</span>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endcan
  @can('almacen.producto.edit')
    <div class="col-sm">
      <div class="card card-info card-outline card-tabs position-relative bg-white">
        <div class="card-body">
          {!! Form::open(['route' => ['venta.pedidoActivo.updateMontoTotal', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoUpdateMontoTotal']) !!}
            <div class="form-group row">
              <label for="monto_total" class="col-sm-5 col-form-label">{{ __('Monto total (Con IVA y envió)') }} *</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                    {!! Form::text('monto_total', $pedido->mont_tot_de_ped, ['id' => 'monto_total', 'class' => 'form-control' . ($errors->has('monto_total') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('Monto total (Con IVA y envió)'), 'onChange' => 'decimal();']) !!}
                  <button type="submit" id="btnsubmit1" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit1', 'ventaPedidoActivoUpdateMontoTotal', '¡Alerta!', '¿Estás seguro quieres cambiar el monto total del pedido?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
                </div>
                <span class="text-danger">{{ $errors->first('monto_total') }}</span>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
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
  @endcan
</div>
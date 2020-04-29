@include('cotizacion.armado_cotizacion.cot_arm_create')
<br><br>
@include('cotizacion.armado_cotizacion.cot_arm_table')

<div class="form-group row justify-content-end p-0 m-0">
  <label for="sub_total">{{ __('SUBTOTAL') }}</label>
  <div class="col-sm-1">
    <div class="input-group">
      $ {{ $cotizacion->sub_total }}
    </div>
  </div>
</div>
<div class="form-group row justify-content-end p-0 m-0">
  <label for="descuento">{{ __('DESCUENTO') }}</label>
  <div class="col-sm-1">
    <div class="input-group">
      {!! Form::text('descuento', $cotizacion->desc, ['class' => 'form-control form-control-sm p-0 m-0' . ($errors->has('descuento') ? ' is-invalid' : ''), 'maxlength' => 15]) !!}
    </div>
  </div>
</div>
<div class="form-group row justify-content-end p-0 m-0">
  <label for="sub_total_descuento">{{ __('SUBTOTAL DESC.') }}</label>
  <div class="col-sm-1">
    <div class="input-group">
      $ {{ bcdiv($cotizacion->sub_total - $cotizacion->desc, '1', 2) }}
    </div>
  </div>
</div>
<div class="form-group row justify-content-end p-0 m-0">
  <label for="iva">{{ __('IVA') }}</label>
  <div class="col-sm-1">
    <div class="input-group">
      $ {{ $cotizacion->iva }}
    </div>
  </div>
</div>
<div class="form-group row justify-content-end p-0 m-0">
  <label for="total">{{ __('TOTAL') }}</label>
  <div class="col-sm-1">
    <div class="input-group">
      $ {{ $cotizacion->tot }}
    </div>
  </div>
</div>
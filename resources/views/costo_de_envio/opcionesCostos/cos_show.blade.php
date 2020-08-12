<h4><label for="redes_sociales">{{ __('INFORMACIÓN') }}</label></h4>
<div class="border border-primary rounded p-3">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="correo_ventas">{{ __('Cotización') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('correo_ventas', $cotizacion->serie, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Cotización'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="tipo">{{ __('Tipo') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('tipo', $armado->tip, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Tipo'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="descripcion">{{ __('Descripción') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('descripcion', $armado->nom.' ('.$armado->sku.')', ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Descripción'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="cantidad">{{ __('Cantidad') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('cantidad', $armado->cant, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
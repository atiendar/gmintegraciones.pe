<div class="form-group col-sm btn-sm">
  <label for="tipo_de_empaque">{{ __('Tipo de empaque') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('tipo_de_empaque', $costo_de_envio->tip_emp, ['class' => 'form-control', 'placeholder' => __('Tipo de empaque'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="referencia_general_de_ubicacion_de_entrega">{{ __('Referencia general de ubicación de entrega') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('referencia_general_de_ubicacion_de_entrega', $armado->ref_gral_de_ubic_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Referencia general de ubicación de entrega'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
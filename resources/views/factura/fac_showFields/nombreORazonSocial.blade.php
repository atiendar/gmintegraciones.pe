<div class="form-group col-sm btn-sm">
  <label for="nombre_o_razon_social">{{ __('Nombre o razón social') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
    </div>
     {!! Form::text('nombre_o_razon_social', $factura->nom_o_raz_soc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre o razón social'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="ciudad_a_la_que_se_cotizo">{{ __('Ciudad a la que se cotizó') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('ciudad_a_la_que_se_cotizo', $armado->ciud_a_la_q_se_cotiz , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ciudad a la que se cotizó'), 'readonly' => 'readonly']) !!}
  </div>
</div>
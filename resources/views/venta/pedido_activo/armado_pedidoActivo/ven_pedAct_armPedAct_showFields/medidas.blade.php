<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', $armado->pes, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Peso'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="alto">{{ __('Alto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
      </div>
      {!! Form::text('alto', $armado->alto, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Alto'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">cm</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="ancho">{{ __('Ancho') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
      </div>
      {!! Form::text('ancho', $armado->ancho, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ancho'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">cm</span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="largo">{{ __('Largo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
      </div>
      {!! Form::text('largo', $armado->largo, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Largo'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">cm</span>
      </div>
    </div>
  </div>
</div>
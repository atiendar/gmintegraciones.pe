<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($armado->img_nom != null)
        <img src="{{ Storage::url($armado->img_rut.$armado->img_nom) }}" class="profile-user-img img-fluid" alt="{{ $armado->img_nom }}">
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $armado->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_arm">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_arm', $armado->created_at_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha ultima modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('updated_at', $armado->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ultima modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_arm">{{ __('Ultima modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_arm', $armado->updated_at_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ultima modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', [$armado->tip => $armado->tip], $armado->tip, ['class' => 'form-control select2', 'placeholder' => __('')]) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre">{{ __('Nombre') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
      </div>
        {!! Form::text('nombre', $armado->nom, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('sku', $armado->sku , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('SKU'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="gama">{{ __('Gama') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
      </div>
      {!! Form::select('gama', [$armado->gama => $armado->gama], $armado->gama, ['class' => 'form-control disabled select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="destacado">{{ __('Destacado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-star"></i></span>
      </div>
      {!! Form::select('destacado', config('opcionesSelect.select_destacado'), $armado->dest, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
      </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL página') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', $armado->url_pagina, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('URL página'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', $armado->pes, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('peso'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_original">{{ __('Precio original') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
        {!! Form::text('precio_original', $armado->prec_origin, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio original'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_redondeado">{{ __('Precio redondeado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
        {!! Form::text('precio_redondeado', $armado->prec_redond, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio redondeado'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<label for="redes_sociales">{{ __('MEDIDAS') }}</label>
  <div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="alto">{{ __('Alto') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
        </div>
        {!! Form::text('alto', $armado->alto, ['class' => 'form-control disabled' . ($errors->has('alto') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Alto'), 'readonly' => 'readonly']) !!}
        <div class="input-group-prepend">
          <span class="input-group-text">cm</span>
        </div>
      </div>
      <span class="text-danger">{{ $errors->first('alto') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="ancho">{{ __('Ancho') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
        </div>
        {!! Form::text('ancho', $armado->ancho, ['class' => 'form-control disabled' . ($errors->has('ancho') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Ancho'), 'readonly' => 'readonly']) !!}
        <div class="input-group-prepend">
          <span class="input-group-text">cm</span>
        </div>
      </div>
      <span class="text-danger">{{ $errors->first('ancho') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="largo">{{ __('Largo') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
        </div>
        {!! Form::text('largo', $armado->largo, ['class' => 'form-control disabled' . ($errors->has('largo') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Largo'), 'readonly' => 'readonly']) !!}
        <div class="input-group-prepend">
          <span class="input-group-text">cm</span>
        </div>
      </div>
      <span class="text-danger">{{ $errors->first('largo') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $armado->obs, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Observaciones'), 'rows' => 0, 'cols' => 0, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection
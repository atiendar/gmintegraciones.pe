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
    <label for="tipo">{{ __('Tipo') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', $tipo_list, $armado->tip, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre">{{ __('Nombre') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
      </div>
        {!! Form::text('nombre', $armado->nom, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Nombre')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('sku', $armado->sku , ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="gama">{{ __('Gama') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
      </div>
      {!! Form::select('gama', $gamas_list, $armado->gama, ['class' => 'form-control select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('gama') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="destacado">{{ __('Destacado') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-star"></i></span>
      </div>
      {!! Form::select('destacado', config('opcionesSelect.select_destacado'), $armado->dest, ['class' => 'form-control select2' . ($errors->has('destacado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
    <span class="text-danger">{{ $errors->first('destacado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_armado">{{ __('Imagen del armado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('imagen_del_armado', ['id' => 'imagen_del_armado', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_armado", "visualizar-imagen_del_armado")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_armado') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen_del_armado"></div>
      </figure>
    </center>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL página') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', $armado->url_pagina, ['class' => 'form-control' . ($errors->has('url_pagina') ? ' is-invalid' : ''), 'maxlength' => 150, 'placeholder' => __('URL página')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('url_pagina') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', $armado->pes, ['class' => 'form-control disabled' . ($errors->has('url_pagina') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('peso'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('peso') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_original">{{ __('Precio original') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_original', $armado->prec_origin, ['class' => 'form-control disabled' . ($errors->has('precio_original') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Precio original'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('precio_original') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_redondeado">{{ __('Precio redondeado') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_redondeado', $armado->prec_redond, ['class' => 'form-control disabled' . ($errors->has('precio_redondeado') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Precio redondeado'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('precio_redondeado') }}</span>
  </div>
</div>
<label for="redes_sociales">{{ __('MEDIDAS') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="alto">{{ __('Alto') }} *</label>
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
      <label for="ancho">{{ __('Ancho') }} *</label>
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
      <label for="largo">{{ __('Largo') }} *</label>
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
      {!! Form::textarea('observaciones', $armado->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 65500, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
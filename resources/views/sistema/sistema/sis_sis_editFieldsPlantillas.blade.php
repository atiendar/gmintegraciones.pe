<label for="redes_sociales">{{ __('PLANTILLAS') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_modulo_usuarios">{{ __('Plantilla por default módulo usuarios') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_modulo_usuarios', $plantillas_usu, Sistema::datos()->sistemaFindOrFail()->plant_usu, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_modulo_usuarios') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_modulo_usuarios') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_modulo_clientes">{{ __('Plantilla por default módulo clientes') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_modulo_clientes', $plantillas_cli, Sistema::datos()->sistemaFindOrFail()->plant_cli, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_modulo_clientes') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_modulo_clientes') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_modulo_perfil">{{ __('Plantilla por default módulo perfil') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_modulo_perfil', $plantillas_per_camb_pass, Sistema::datos()->sistemaFindOrFail()->plant_per_camb_pass, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_modulo_perfil') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_modulo_perfil') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_restaurar_password">{{ __('Plantilla por default restaurar contraseña') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_restaurar_password', $plantillas_sis_rest_pass, Sistema::datos()->sistemaFindOrFail()->plant_sis_rest_pass, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_restaurar_password') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_restaurar_password') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_modulo_cotizaciones">{{ __('Plantilla por default módulo cotizaciones') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_modulo_cotizaciones', $plantillas_cotizaciones, Sistema::datos()->sistemaFindOrFail()->plant_cot, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_modulo_cotizaciones') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_modulo_cotizaciones') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="plantilla_por_default_modulo_ventas">{{ __('Plantilla por default módulo ventas') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-brush"></i></span>
        </div>
        {!! Form::select('plantilla_por_default_modulo_ventas', $plantillas_ventas, Sistema::datos()->sistemaFindOrFail()->plant_vent, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_modulo_ventas') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('plantilla_por_default_modulo_ventas') }}</span>
    </div>
  </div>
</div>
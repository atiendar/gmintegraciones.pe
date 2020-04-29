<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_plantilla">{{ __('Nombre de la plantilla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-brush"></i></span>
      </div>
       {!! Form::text('nombre_de_la_plantilla', null, ['class' => 'form-control' . ($errors->has('nombre_de_la_plantilla') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Nombre de la plantilla')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_plantilla') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="modulo">{{ __('Módulo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('modulo', config('opcionesSelect.select_modulo'), null, ['class' => 'form-control modulo']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('modulo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="asunto">{{ __('Asunto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('asunto', null, ['class' => 'form-control' . ($errors->has('asunto') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Asunto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('asunto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="diseno_de_la_plantilla">{{ __('Diseño de la plantilla') }} *</label>
    <div class="input-group">
       {!! Form::textarea('diseno_de_la_plantilla', null, ['class' => 'form-control textarea' . ($errors->has('diseno_de_la_plantilla') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('diseno_de_la_plantilla') }}</span>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('sistema.plantilla.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Crear') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_summernote')
@section('js1')
<script>
  otros = [
    'nombre_completo_del_usuario !', 
    'nombre_del_usuario !', 
    'apellido_del_usuario !', 
    'email_registro_del_usuario !', 
    'nombre_de_la_empresa !', 
    'year_de_inicio_de_la_empresa !', 
    'pagina_web_de_la_empresa !', 
    'pagina_de_inicio_del_sistema !', 
    'year_actual !'
/*
  // Modulo Clientes y Usuarios
    'password !',
  // Sistema
    'minutos !',
    'url_cambio_de_password !'
*/
  ]
  $(document).ready(function(){
    $(".modulo").change(function(){
      var selectedCountry = $(this).children("option:selected").val();
      if(selectedCountry == 'Clientes') {
        otros.push(['aaa !', 'bbb !', 'cccc !']);
      }
    });
  });
  $('.textarea').summernote({
    tabsize: 4,
    height: 500,
    width: 1500,
    @if(Auth::user()->lang == 'es') lang: "es-ES", @endif
    hint: {
      match: /\B@(\w*)$/,
      search: function (keyword, callback) {
        callback($.grep(otros, function (item) {
          return item.indexOf(keyword) == 0;
        }));
      },
      content: function (item) {
        return '{!! $' + item + '!}';
      }    
    }
  });
</script>
@endsection
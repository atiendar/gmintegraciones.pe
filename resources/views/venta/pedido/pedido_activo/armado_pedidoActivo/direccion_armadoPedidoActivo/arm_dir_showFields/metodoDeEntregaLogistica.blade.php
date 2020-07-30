<label for="envio_al_que_se_cotizo">{{ __('ENVÍO DEFINIDO POR LOGÍSTICA') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega', $direccion->met_de_entreg_de_log, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega_espesifico', $direccion->met_de_entreg_de_log_esp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega espesifico'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="url_rastreo">{{ __('URL rastreo') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('url_rastreo', $direccion->url, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('URL rastreo'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    @if(!$comprobantes->isEmpty())
      <div class="form-group col-sm btn-sm">
        <label for="numero_de_guia">{{ __('Número de guia') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
          {!! Form::text('numero_de_guia', $comprobantes[0]->num_guia, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Número de guia'), 'readonly' => 'readonly']) !!}
        </div>
      </div>
    @endif
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="costo_por_envio_logistica">{{ __('Costo de envío') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('costo_por_envio_logistica', Sistema::dosDecimales($direccion->cost_por_env_log), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
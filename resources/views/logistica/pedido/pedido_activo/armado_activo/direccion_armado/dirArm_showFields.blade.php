<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $direccion->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_direc_arm">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_direc_arm', $direccion->created_at_direc_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('updated_at', $direccion->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_direc_arm">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_direc_arm', $direccion->updated_at_direc_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('cantidad', $direccion->cant, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatus', ['armado' => $direccion])
</div>
<label for="envio_al_que_se_cotizo">{{ __('ENVÍO AL QUE SE COTIZO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega', $direccion->met_de_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="estado">{{ __('Estado') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('estado', $direccion->est, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Estado'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="foraneo_o_local">{{ __('Foráneo o local') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('foraneo_o_local', $direccion->for_loc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Foráneo o local'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="tipo_de_envio">{{ __('Tipo de envío') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('tipo_de_envio', $direccion->tip_env, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="costo_por_envio">{{ __('Costo de envío') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('costo_por_envio', Sistema::dosDecimales($direccion->cost_por_env), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('detalles_de_la_ubicacion', $direccion->detalles_de_la_ubicacion, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Detalles de la ubicación'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
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
<div class="row">
  @if($direccion->comp_de_sal_nom != NULL)
    <div class="form-group col-sm btn-sm">
      <a href="{{ Storage::url($direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom) }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <label for="comprobante_de_salida">{{ __('Comprobante de salida') }}</label> {{ $direccion->created_com_sal }} ({{ $direccion->fech_car_comp_de_sal }})
      <div class="form-group col-sm btn-sm">
        <div class="pad box-pane-right no-padding" style="min-height: 280px">
          <iframe src="{{ Storage::url($direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom) }}" style="width:100%;border:none;height:15rem;"></iframe>
        </div>
      </div>
    </div>
  @endif
  @if(!$comprobantes->isEmpty())
    @if($comprobantes[0]->comp_ent_nom != NULL)
      <div class="form-group col-sm btn-sm">
        <a href="{{ Storage::url($comprobantes->comp_ent_rut.$comprobantes->comp_ent_nom) }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
        <label for="comprobante_de_salida">{{ __('Comprobante de entrega') }}</label> {{ $comprobantes[0]->created_at_comp }} ({{ $comprobantes[0]->created_at }})
        <div class="form-group col-sm btn-sm">
          <div class="pad box-pane-right no-padding" style="min-height: 280px">
            <iframe src="{{ Storage::url($comprobantes[0]->comp_ent_rut.$comprobantes[0]->comp_ent_nom) }}" style="width:100%;border:none;height:15rem;"></iframe>
          </div>
        </div>
      </div>
    @endif
  @endif
</div>
<label for="envio_al_que_se_cotizo">{{ __('INFORMACIÓN DE ENTREGA') }}</label>
<div class="border border-primary rounded p-2">
  @include('rolCliente.direccion.dir_showFields')
</div>
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
<label for="redes_sociales">{{ __('INFORMACIÓN EXTRA DEL ARMADO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="col-md-8">
      <div class="pad">
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="tipo_de_tarjeta_de_felicitacion">{{ __('Tipo de tarjeta de felicitación') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list"></i></span>
              </div>
              {!! Form::select('tipo_de_tarjeta_de_felicitacion', config('opcionesSelect.select_tarjeta_de_felicitacion'), $direccion->tip_tarj_felic, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
            </div>
          </div>
        </div>
        <div class="row" id="mensaje_de_dedicatoria">
          <div class="form-group col-sm btn-sm">
            <label for="mensaje_de_dedicatoria">{{ __('Mensaje de dedicatoria') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-text-width"></i></span>
              </div>
              {!! Form::textarea('mensaje_de_dedicatoria',  $direccion->mens_dedic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Mensaje de dedicatoria'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      @if($direccion->tarj_dise_nom != null)
        <div class="form-group col-sm btn-sm">
          <label for="comentarios">{{ __('Tarjeta diseñada por el cliente') }}</label>
          <div class="pad box-pane-right no-padding" style="min-height: 280px">
            <iframe src="{{ Storage::url($direccion->tarj_dise_rut.$direccion->tarj_dise_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
<label for="redes_sociales">{{ __('MÉTODO DE ENTREGA DE VENTAS') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="estado">{{ __('Estado') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('estado', $direccion->est, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Estado'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega', $direccion->met_de_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
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
        {!! Form::text('foraneo_o_local', $direccion->tip_env, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="costo_por_envio">{{ __('Costo por envío') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('costo_por_envio', $direccion->cost_por_env, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo por envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width "></i></span>
        </div>
        {!! Form::textarea('detalles_de_la_ubicacion', $direccion->detalles_de_la_ubicacion, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Detalles de la ubicación'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
<label for="redes_sociales">{{ __('MÉTODO DE ENTREGA DE LOGÍSTICA') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="col-md-8">
      <div class="pad">
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
            <label for="numero_de_guia">{{ __('Número de guia') }}</label>
            @if($direccion->url != null)
              <a href="{{ $direccion->url }}" target="_blank">{{ ('Rastrear pedido') }}</a>
            @endif
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-text-width"></i></span>
              </div>
              {!! Form::text('numero_de_guia', $direccion->num_guia, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Número de guia'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      @if($direccion->comp_de_sal_nom != null)
        <div class="form-group col-sm btn-sm">
          <label for="comentarios">{{ __('Comprobante de salida') }}</label>
          <div class="pad box-pane-right no-padding" style="min-height: 280px">
            <iframe src="{{ Storage::url($direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
<label for="redes_sociales">{{ __('DATOS DIRECCIÓN DE ENTREGA') }}</label>
<div class="border border-primary rounded p-2">
  @include('rolCliente.direccion.dir_showFields')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{  route('venta.pedidoActivo.armado.show', Crypt::encrypt($direccion->pedido_armado_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el armado') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoArmadoDirecionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
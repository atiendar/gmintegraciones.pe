<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
        {!! Form::text('created_at', $pago->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_us">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_us', $pago->created_at_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
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
        {!! Form::text('updated_at', $pago->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_us">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_us', $pago->updated_at_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="numero_de_pedido">{{ __('Número de pedido') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('numero_de_pedido', $pago->pedido->serie.$pago->pedido->id, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Número de pedido'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@switch($pago->estat_pag)
  @case(config('app.aprobado'))
  @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.rechazado'))
  @php $borde = config('app.color_c'); @endphp
    @break
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @default
  @php $borde = config('app.color_null'); @endphp
@endswitch
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_facturacion">{{ __('Código de facturación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('codigo_de_facturacion', $pago->cod_fact, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código de facturación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="estatus_pago">{{ __('Estatus pago') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('estatus_pago', $pago->estat_pag, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus pago'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="forma_de_pago">{{ __('Forma de pago') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('forma_de_pago', $pago->form_de_pag, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Forma de pago'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="monto_de_pago">{{ __('Monto de pago') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('monto_de_pago', Sistema::dosDecimales($pago->mont_de_pag), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Monto de pago'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('comentarios', $pago->coment_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  @if($pago->comp_de_pag_nom != null)
    <div class="form-group col-sm btn-sm">
      <label for="comentarios">{{ __('Comprobante de pago') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ Storage::url($pago->comp_de_pag_rut.$pago->comp_de_pag_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
  @if($pago->cop_de_indent_nom != null)
    <div class="form-group col-sm btn-sm">
      <label for="comentarios">{{ __('Copia de identificación') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ Storage::url($pago->cop_de_indent_rut.$pago->cop_de_indent_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
</div>
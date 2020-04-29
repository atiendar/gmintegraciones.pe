<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="serie">{{ __('Serie') }} *</label>
    @can('sistema.serie.create')
      <a href="{{ route('sistema.serie.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar serie') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('serie', $series_list, null, ['class' => 'form-control select2' . ($errors->has('serie') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('serie') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="validez">{{ __('Validez') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::date('validez', date("Y-m-d", strtotime('+30 day', strtotime(date("Y-m-d")))), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('validez') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_del_cliente">{{ __('Correo del cliente') }} *</label>
    @can('cliente.create')
      <a href="{{ route('cliente.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar cliente') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::select('correo_del_cliente', $clientes_list, null, ['class' => 'form-control select2' . ($errors->has('correo_del_cliente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
    <span class="text-danger">{{ $errors->first('correo_del_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Crear') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
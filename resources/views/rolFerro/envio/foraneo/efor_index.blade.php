@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de envios'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolFerro.envio.local.eloc_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolFerro.envioForaneo.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolFerro.envioForaneo.index'), 'opciones_buscador' => config('opcionesSelect.select_logistica_direcciones_index')])
    {!! Form::close() !!}
    @include('rolFerro.envio.local.eloc_table')
    <div class="row">
      <div class="form-group col-sm btn-sm" >
        <a href="{{ route('rolFerro.envioForaneo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
      </div>
      <div class="form-group col-sm btn-sm">
        <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolFerroEnvioLocalUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
      </div>
    </div>
    @include('global.paginador.paginador', ['paginar' => $envios])
  </div>
</div>
@endsection
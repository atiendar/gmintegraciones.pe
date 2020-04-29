@extends('layouts.private.perfil.dashboard')
@section('titulo')
<title>@section('title', __('Notificaciones'))</title>
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('Notificaciones') }}</h1>
</div>
@endsection
@section('contenido')
<div class="card card-primary card-outline">
  <div class="p-2">
    {!! Form::model(Request::all(), ['route' => 'perfil.notificacion.index', 'method' => 'GET']) !!}
    <div style="float: right;">
      <div class="input-group input-group-sm" style="width: 25em;">
        {!! Form::select('opcion_buscador', config('opcionesSelect.select_perfil_notificacion_index'), null, ['class' => 'form-control float-right']) !!}
        {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' => __('Buscador'), 'title' => __('Enter para buscar')]) !!} 
        <div class="input-group-append">
          <button type="submit" class="btn btn-default" title="{{ __('Buscar') }}"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
    <div class="input-group input-group-sm" style="width: 13em;">
      {{ __('Mostrar') }} 
      &nbsp{!! Form::select('paginador', ['15' => '15', '30' => '30', '50' => '50'], null, ['class' => 'form-control btn-sm w-25', 'onchange' => 'this.form.submit()']) !!}&nbsp 
      {{ __('registros') }}.
      <span class="text-danger">{{ $errors->first('paginador') }}</span>
    </div>
    {!! Form::close() !!}
  </div>
  <div class="card-body p-0">
    <div class="mailbox-controls">
      <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm" id="marcarComoVisto" style="display: none;" title="{{ __('Marcar como visto') }}"  onClick='return marcarComoVisto()'><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-default btn-sm" id="marcarComoNoVisto" style="display: none;" title="{{ __('Marcar como no visto') }}"  onClick='return marcarComoNoVisto()'><i class="fas fa-eye-slash"></i></button>
      </div>
    </div>
    @include('perfil.notificacion.per_not_table')
  </div>
  <div class="p-2">
    <div style="float: right;">
      {!! $notificaciones->appends(Request::all())->links() !!}  
    </div>
    {{ __('Mostrando desde') . ' '. $notificaciones->firstItem() . ' ' . __('hasta') . ' '. $notificaciones->lastItem() . ' ' . __('de') . ' '. $notificaciones->total() . ' ' . __('registros') }}.
  </div>
</div>
@endsection
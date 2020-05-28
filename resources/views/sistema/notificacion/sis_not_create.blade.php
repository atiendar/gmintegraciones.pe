@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Enviar notificación'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::open(['route' => 'sistema.notificacion.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('sistema.notificacion.sis_not_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
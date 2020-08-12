@extends('layouts.public.dashboard')
@section('header')
<title>@section('title', __('Solicitar soporte'))</title>
@endsection
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<div class="container">
  <div  class="container-fluid">
    <div class="card-body">
      <h1>Solicitar Soporte</h1>
        {!! Form::open(['route' => 'soporte.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
         @include('tecnologia_de_la_informacion.soporte.ti_sop_createFields')
        {!! Form::close() !!}
    </div>  
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar costo de envío'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('costo_de_envio.cos_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'costoDeEnvio.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('costo_de_envio.cos_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar catálogo'))</title>
<div class="card card-info card-outline card-tabs">
  <div class="card-header p-1 border-bottom">
    <h5 class="box-title">{{ __('Registrar catálogo') }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'sistema.catalogo.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('sistema.catalogo.sis_cat_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
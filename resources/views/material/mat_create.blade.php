@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar material'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('material.mat_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'material.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('material.mat_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
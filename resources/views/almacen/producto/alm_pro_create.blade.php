@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar producto'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('almacen.producto.alm_pro_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'almacen.producto.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('almacen.producto.alm_pro_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
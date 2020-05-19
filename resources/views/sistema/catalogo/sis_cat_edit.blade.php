@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar catálogo').' '.$catalogo->vista)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('sistema.catalogo.show')
        <a href="{{ route('sistema.catalogo.show', Crypt::encrypt($catalogo->id)) }}">{{ $catalogo->vista }}</a>
      @else
        {{ $catalogo->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info"> 
      <small>{{ $catalogo->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.catalogo.update', Crypt::encrypt($catalogo->id)], 'method' => 'patch', 'id' => 'sistemaCatalogoUpdate', 'files' => true]) !!}
      @include('sistema.catalogo.sis_cat_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
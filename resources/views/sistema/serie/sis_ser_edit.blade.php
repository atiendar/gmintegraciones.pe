@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar serie').' '.$serie->vista)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('sistema.serie.show')
        <a href="{{ route('sistema.serie.show', Crypt::encrypt($serie->id)) }}">{{ $serie->vista }}</a>
      @else
        {{ $serie->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info"> 
      <small>{{ $serie->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.serie.update', Crypt::encrypt($serie->id)], 'method' => 'patch', 'id' => 'sistemaSerieUpdate']) !!}
      @include('sistema.serie.sis_ser_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
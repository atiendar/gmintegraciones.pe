@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar contacto'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('proveedor.contacto.show')
        <a href="{{ route('proveedor.contacto.show', Crypt::encrypt($contacto->id)) }}">{{ $contacto->nom }}</a>
      @else
        {{ $contacto->nom }}
      @endcan
      <strong>{{ __('del proveedor') }}:</strong> {{ $contacto->proveedor->nom_comerc }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $contacto->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['proveedor.contacto.update', Crypt::encrypt($contacto->id)], 'method' => 'patch', 'id' => 'contactoUpdate']) !!}
      @include('proveedor.contacto_proveedor.pro_conPro_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
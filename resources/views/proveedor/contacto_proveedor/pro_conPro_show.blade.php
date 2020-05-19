@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles contacto').' '.$contacto->nom)</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('proveedor.contacto.edit')
        <a href="{{ route('proveedor.contacto.edit', Crypt::encrypt($contacto->id)) }}">{{ $contacto->nom }}</a>
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
    @include('proveedor.contacto_proveedor.pro_conPro_showFields')
  </div>
</div>
@endsection
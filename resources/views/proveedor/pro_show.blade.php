@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles proveedor'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    @if($proveedor->arch_rut != null)
      <ul class="nav nav-pills float-right pr-5">
        <li class="nav-item dropdown ml-auto border rounded">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-archive"></i> {{ __('Archivos') }} <i class="fas fa-sort-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ $proveedor->arch_rut.$proveedor->arch_nom }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ $proveedor->arch_nom }}</a>
            <div class="dropdown-divider"></div>
            </div>
        </li>
      </ul>
    @endif
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('proveedor.edit')
        <a href="{{ route('proveedor.edit', Crypt::encrypt($proveedor->id)) }}">{{ $proveedor->nom_comerc }}</a>
      @else
        {{ $proveedor->nom_comerc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $proveedor->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('proveedor.pro_showFields')
  </div>
</div>
@include('proveedor.contacto_proveedor.pro_conPro_index')
@endsection
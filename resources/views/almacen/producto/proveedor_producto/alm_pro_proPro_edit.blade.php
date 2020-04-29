@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar proveedor del producto'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar proveedor') }}: </strong>
      {{ $proveedor_producto->nom_comerc }},
      <strong>{{ __('del producto') }}: </strong>
      {{ $producto->produc  }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info"> 
      <small>{{ $proveedor_producto->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.producto.proveedor.update', Crypt::encrypt($producto->id), Crypt::encrypt($proveedor_producto->id)], 'method' => 'patch', 'id' => 'almacenProductoUpdate', 'files' => true]) !!}
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_editFields')
    {!! Form::close() !!}
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar proveedor'))</title>
<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Registrar proveedor al producto') }}:</strong> {{ $producto->produc }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.producto.proveedor.store', Crypt::encrypt($producto->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
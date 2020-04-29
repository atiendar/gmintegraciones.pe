@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar contacto'))</title>
<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Registrar contacto al proveedor') }}:</strong> {{ $proveedor->nom_comerc }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['proveedor.contacto.store', Crypt::encrypt($proveedor->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('proveedor.contacto_proveedor.pro_conPro_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
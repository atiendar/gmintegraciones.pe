@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar pedido'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('venta.ven_ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'venta.pedidoActivo.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('venta.pedido_activo.ven_pedAct_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('Inicio') }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Inicio'))</title>
@if(auth()->user()->hasRole(config('app.rol_cliente')))

  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><i class="icon fas fa-info"></i> Info</h3>
    <h4>
      {{ __('Bienvenido a') }} {{ Sistema::datos()->sistemaFindOrFail()->emp }} {{ __('en este portal podrás darle seguimiento a tus pedidos, solicitar tus facturas y registrar tus pagos') }}.
    </h4>
  </div>

  <div class="row">

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="https://canastasyarcones.mx/contacto/" target="_blank" class="text-dark">{{ __('Cotizar') }} <i class="fas fa-arrow-circle-right"></i></a>
          </h2>
          <p>{{ __('Llenar formulario') }}</p>
        </div>
        <div class="icon">
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.pedido.index') }}" class="text-dark">{{ __('Ver pedidos') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon">
          <i class="ion fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.pago.create') }}" class="text-dark">{{ __('Registrar pago') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon"> 
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.factura.create') }}" class="text-dark">{{ __('Solicitar factura') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon">
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>
  </div>

@endif
@endsection
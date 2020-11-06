@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar envio').' '.$envio->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
        <a href="{{ route('rolFerro.envioLocal.show', Crypt::encrypt($envio->id)) }}" class="text-white">{{ $envio->est }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $envio->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['rolFerro.envioLocal.update', Crypt::encrypt($envio->id)], 'method' => 'patch', 'id' => 'rolFerroEnvioLocalUpdate']) !!}
      @include('rolFerro.envio.local.eloc_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
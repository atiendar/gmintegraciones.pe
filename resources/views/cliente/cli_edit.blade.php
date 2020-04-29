@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Editar cliente'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('cliente.show')
        <a href="{{ route('cliente.show', Crypt::encrypt($cliente->id)) }}">{{ $cliente->nom }}</a>
      @else
        {{ $cliente->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $cliente->id }}</small> 
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['cliente.update', Crypt::encrypt($cliente->id)], 'method' => 'patch', 'id' => 'clienteUpdate', 'files' => true]) !!}
      @include('cliente.cli_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
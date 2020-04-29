@extends('layouts.private.perfil.dashboard')
@section('contenido')
<title>@section('title', __('Detalles notificación'))</title>
<div class="container">
<div class="callout callout-info p-2">
  @include('perfil.notificacion.per_not_showFields')
</div>
@endsection 
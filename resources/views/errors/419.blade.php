@extends('errors::illustrated-layout')

@section('title', __('Página caducada'))
@section('code', '419')
@section('message', __('Página caducada'))
@section('image')
<img src="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error) }}">
@endsection
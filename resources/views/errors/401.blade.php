@extends('errors::illustrated-layout')

@section('title', __('No autorizado'))
@section('code', '401')
@section('message', __('No autorizado'))
@section('image')
<img src="{{ Storage::url(Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error) }}">
@endsection
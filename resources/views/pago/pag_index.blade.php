@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pagos'))</title>
<div class="card">
  <div class="card-body">
    <div class="pb-1">
      {!! Form::model(Request::all(), ['route' => 'pago.index', 'method' => 'GET']) !!}
      <div style="float: right;">
        <div class="input-group input-group-sm" style="width: 25em;">
          {!! Form::select('opcion_buscador', config('opcionesSelect.select_pago_index'), null, ['class' => 'form-control float-right']) !!}
          {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' => __('Buscador'), 'title' => __('Enter para buscar')]) !!} 
          <div class="input-group-append">
            <button type="submit" class="btn btn-default" title="{{ __('Buscar') }}"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
      <div class="input-group input-group-sm" style="width: 13em;">
        {{ __('Mostrar') }} 
        &nbsp{!! Form::select('paginador', ['15' => '15', '30' => '30', '50' => '50'], null, ['class' => 'form-control btn-sm w-25', 'onchange' => 'this.form.submit()']) !!}&nbsp 
        {{ __('registros') }}.
        <span class="text-danger">{{ $errors->first('paginador') }}</span>
      </div>
      {!! Form::close() !!}
    </div>
    @include('pago.pag_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $pagos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $pagos->firstItem() . ' ' . __('hasta') . ' '. $pagos->lastItem() . ' ' . __('de') . ' '. $pagos->total() . ' ' . __('registros') }}.
    </div>
  </div>
</div>
@endsection
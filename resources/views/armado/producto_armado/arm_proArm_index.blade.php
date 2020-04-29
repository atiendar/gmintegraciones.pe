<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @include('armado.producto_armado.arm_proArm_create')
    <h5>{{ __('Productos') }}</h5> 
  </div>
  <div class="card-body">
    <div class="pb-1">
      {!! Form::model(Request::all(), ['route' => [Request::is('armado/editar/*') ? 'armado.edit' : 'armado.show', Crypt::encrypt($armado->id)], 'method' => 'GET']) !!}
      <div style="float: right;">
        <div class="input-group input-group-sm" style="width: 25em;">
          {!! Form::select('opcion_buscador', config('opcionesSelect.select_producto_armado_index'), null, ['class' => 'form-control float-right']) !!}
          {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' => __('Buscador'), 'title' => __('Enter para buscar')]) !!} 
          <div class="input-group-append">
            <button type="submit" class="btn btn-default" title="{{ __('Buscar') }}"><i class="fas fa-search"></i></button>
          </div>&nbsp&nbsp&nbsp
          <div class="input-group-append">
            <a href="{{ route(Request::is('armado/editar/*') ? 'armado.edit' : 'armado.show', Crypt::encrypt($armado->id)) }}" class="btn btn-default" title="{{ __('Mostrar todos los registros') }}"><i class="fas fa-spinner"></i></a>
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
    @include('armado.producto_armado.arm_proArm_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $productos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $productos->firstItem() . ' ' . __('hasta') . ' '. $productos->lastItem() . ' ' . __('de') . ' '. $productos->total() . ' ' . __('registros') }}.
    </div>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
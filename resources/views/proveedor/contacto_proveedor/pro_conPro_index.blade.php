<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto tex">
    @can('proveedor.contacto.create')
      @if(Request::route()->getName() == 'proveedor.edit')
        <a href="{{ route('proveedor.contacto.create', Crypt::encrypt($proveedor->id)) }}" class="btn btn-primary btn-sm float-right">{{ __('Registrar contacto') }}</a>
      @endif
    @endcan
    <h5>{{ __('Contactos') }}</h5> 
  </div>
  <div class="card-body">
    <div class="pb-1">
      {!! Form::model(Request::all(), ['route' => [Request::is('proveedor/editar/*') ? 'proveedor.edit' : 'proveedor.show', Crypt::encrypt($proveedor->id)], 'method' => 'GET']) !!}
      <div style="float: right;">
        <div class="input-group input-group-sm" style="width: 25em;">
          {!! Form::select('opcion_buscador', config('opcionesSelect.select_contactos_proveedor_index'), null, ['class' => 'form-control float-right']) !!}
          {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' => __('Buscador'), 'title' => __('Enter para buscar')]) !!} 
          <div class="input-group-append">
            <button type="submit" class="btn btn-default" title="{{ __('Buscar') }}"><i class="fas fa-search"></i></button>
          </div>&nbsp&nbsp&nbsp
          <div class="input-group-append">
            <a href="{{ route(Request::is('proveedor/editar/*') ? 'proveedor.edit' : 'proveedor.show', Crypt::encrypt($proveedor->id)) }}" class="btn btn-default" title="{{ __('Mostrar todos los registros') }}"><i class="fas fa-spinner"></i></a>
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
    @include('proveedor.contacto_proveedor.pro_conPro_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $contactos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $contactos->firstItem() . ' ' . __('hasta') . ' '. $contactos->lastItem() . ' ' . __('de') . ' '. $contactos->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
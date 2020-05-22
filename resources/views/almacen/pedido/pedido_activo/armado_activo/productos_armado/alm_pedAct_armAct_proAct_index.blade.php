<div class="card card-info card-outline">
    <div class="card-header p-1">
      <h5>
        <strong>{{ __('Productos registrados') }} </strong>
      </h5>
    </div>
    <div class="card-body">
        <div class="pb-1">
          {!! Form::model(Request::all(), ['route' => ['almacen.pedidoActivo.armadoPedidoActivo.edit',Crypt::encrypt($armado->id)],'method' => 'GET']) !!}
          <div style="float: right;">
            <div class="input-group input-group-sm" style="width: 25em;">
              {!! Form::select('opcion_buscador', config('opcionesSelect.select_productos_armado_index'), null, ['class' => 'form-control float-right']) !!}
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
          </div>
          {!! Form::close() !!}
        </div>
        @include('almacen.pedido_activo.armado_activo.productos_armado.alm_pedAct_armAct_proAct_table')
        <div class="pt-2">
            <div style="float: right;">
              {!! $productos->appends(Request::all())->links() !!}  
            </div>
            {{ __('Mostrando desde') . ' '. $productos->firstItem() . ' ' . __('hasta') . ' '. $productos->lastItem() . ' ' . __('de') . ' '. $productos->total() . ' ' . __('registros') }}.
        </div>
    </div>
</div>
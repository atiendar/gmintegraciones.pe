<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @can('almacen.producto.proveedor.create')
      @if(Request::route()->getName() == 'almacen.producto.edit')
        <div class="float-right">
          <a href="{{ route('almacen.producto.proveedor.create', Crypt::encrypt($producto->id)) }}" class="btn btn-primary">{{ __('Registrar proveedor') }}</a>
        </div>
      @endif
    @endcan
    <h5>{{ __('Proveedores') }}</h5> 
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_table')
    </div>
    <div class="pt-2">
      <div style="float: right;">
        {!! $proveedores->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $proveedores->firstItem() . ' ' . __('hasta') . ' '. $proveedores->lastItem() . ' ' . __('de') . ' '. $proveedores->total() . ' ' . __('registros') }}.
    </div> 
  </div>
</div>
<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @include('almacen.producto.sustitutos_producto.alm_pro_susPro_create')
    <h5>{{ __('Sustitutos') }}</h5> 
  </div>
  <div class="card-body">
    @include('almacen.producto.sustitutos_producto.alm_pro_susPro_table', [$productos = $sustitutos])
    <div class="pt-2">
      <div style="float: right;">
        {!! $sustitutos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $sustitutos->firstItem() . ' ' . __('hasta') . ' '. $sustitutos->lastItem() . ' ' . __('de') . ' '. $sustitutos->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
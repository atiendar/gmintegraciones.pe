<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_create')
    <h5>{{ __('Productos') }}</h5> 
  </div>
  <div class="card-body">
    @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $productos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $productos->firstItem() . ' ' . __('hasta') . ' '. $productos->lastItem() . ' ' . __('de') . ' '. $productos->total() . ' ' . __('registros') }}.
    </div>
  </div>
</div>
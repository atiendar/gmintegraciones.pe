<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @if(Request::route()->getName() == 'venta.pedidoActivo.edit')
      @can('venta.pedidoActivo.armado.create')
        <a href="{{ route('venta.pedidoActivo.armado.create', Crypt::encrypt($pedido->id)) }}" class="btn btn-primary">{{ __('Cargar armado') }}</a>
      @endcan
    @endcan
    <div class="float-right">
      <h5>{{ __('Armados registrados') }}: {{ Sistema::dosDecimales($pedido->arm_carg) . ' de ' . Sistema::dosDecimales($pedido->tot_de_arm) }}</h5> 
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $armados->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $armados->firstItem() . ' ' . __('hasta') . ' '. $armados->lastItem() . ' ' . __('de') . ' '. $armados->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @can('venta.pedidoActivo.armado.create')
      <a href="{{ route('venta.pedidoActivo.armado.create', Crypt::encrypt($pedido->id)) }}" class="btn btn-primary">{{ __('Cargar armado') }}</a>
    @endcan
    <div class="float-right">
      <h5>{{ __('Armados registrados') }}: {{ $pedido->arm_carg . ' de ' . $pedido->tot_de_arm }}</h5> 
    </div>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
      @include('venta.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_table')
    </div> 
    <div class="pt-2">
      <div style="float: right;">
        {!! $armados->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $armados->firstItem() . ' ' . __('hasta') . ' '. $armados->lastItem() . ' ' . __('de') . ' '. $armados->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
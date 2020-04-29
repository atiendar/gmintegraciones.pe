<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    @can('venta.pedidoActivo.pago.create')
      <a href="{{ route('venta.pedidoActivo.pago.create', Crypt::encrypt($pedido->id)) }}" class="btn btn-primary">{{ __('Registrar pago') }}</a>
    @endcan
    <div class="float-right">
      <h5>{{ __('Estatus pago') }}: @include('venta.pedido_activo.ven_pedAct_showFields.estatusPago')</h5> 
    </div>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;">
      @include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_table')
    </div> 
    <div class="pt-2">
      <div style="float: right;">
        {!! $pagos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $pagos->firstItem() . ' ' . __('hasta') . ' '. $pagos->lastItem() . ' ' . __('de') . ' '. $pagos->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
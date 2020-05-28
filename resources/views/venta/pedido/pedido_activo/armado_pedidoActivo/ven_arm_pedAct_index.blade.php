<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <div class="float-right">
      <h5>{{ __('Armados registrados') }}: {{ Sistema::dosDecimales($pedido->arm_carg) . ' de ' . Sistema::dosDecimales($pedido->tot_de_arm) }}</h5> 
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_table')
    @include('global.paginador.paginador', ['paginar' => $armados]) 
  </div>
</div>
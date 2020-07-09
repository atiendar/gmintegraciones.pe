<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Comprobantes') }}</h5>
  </div>
  <div class="card-body">
    @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante_de_entrega.comEnt_table')
    @include('global.paginador.paginador', ['paginar' => $comprobantes])
  </div>
</div>
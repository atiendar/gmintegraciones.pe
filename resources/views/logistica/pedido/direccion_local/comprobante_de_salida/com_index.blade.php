<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Comprobantes') }}</h5>
  </div>
  <div class="card-body">
    @include('logistica.pedido.direccion_local.comprobante_de_salida.com_table')
    @include('global.paginador.paginador', ['paginar' => $comprobantes])
  </div>
</div>
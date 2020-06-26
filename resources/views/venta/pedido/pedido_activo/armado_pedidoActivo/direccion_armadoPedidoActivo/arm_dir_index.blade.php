<div class="card {{ config('app.color_card_secundario') }} card-outline">
    <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
      <h5>{{ __('Direcciones') }}</h5> 
    </div>
    <div class="card-body">
      @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table')
      @include('global.paginador.paginador', ['paginar' => $direcciones]) 
    </div>
  </div>
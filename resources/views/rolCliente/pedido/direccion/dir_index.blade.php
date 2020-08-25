<div class="card {{ config('app.color_card_secundario') }}">
  <div class="card-header p-1 {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Direcciones') }}</h5> 
  </div>
  <div class="card-body">
    <h5><center>{{ __('Favor de asignar la dirección espesifica y la persona encargada de recibir el pedido en las diferentes direcciones.') }}</center></h5><br>
    @include('rolCliente.pedido.direccion.dir_table')
  </div>
</div>
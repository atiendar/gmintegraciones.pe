<td> 
  @switch($pedido->estat_alm)
    @case(config('app.asignar_lider_de_pedido'))
      <span class="badge" style="background:{{ config('app.color_e') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_espera_de_ventas'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.en_espera_de_compra'))
      <span class="badge" style="background:{{ config('app.color_k') }}">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_revision_de_productos'))
      <span class="badge" style="background:{{ config('app.color_j') }}">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_revision_de_productos_completosParcial'))
      <span class="badge" style="background:{{ config('app.color_g') }}">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.productos_completos_terminado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $pedido->estat_alm }}</span>
      @break
    @default
      {{ $pedido->estat_alm }}
  @endswitch
</td>
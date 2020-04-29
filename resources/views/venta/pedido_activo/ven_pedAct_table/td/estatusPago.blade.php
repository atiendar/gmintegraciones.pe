<td>
  @switch($pedido->estat_pag)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.anticipo_pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.anticipo_aprobado'))
      <span class="badge" style="background:{{ config('app.color_b') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.anticipo_rechazado'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagototal_pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagototal_aprobado'))
      <span class="badge" style="background:{{ config('app.color_b') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagototal_rechazado'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagado'))
      <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagado_eliminados'))
      <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagoseliminados'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @default
      {{ $pedido->estat_pag }}
  @endswitch
</td>
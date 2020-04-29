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

{{-- 
@switch($pedido->estat_pag)
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.anticipo_pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.anticipo_aprobado'))
    @php $borde = config('app.color_b'); @endphp
    @break
  @case(config('app.anticipo_rechazado'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @case(config('app.pagototal_pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.pagototal_aprobado'))
    @php $borde = config('app.color_b'); @endphp
    @break
  @case(config('app.pagototal_rechazado'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @case(config('app.pagado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.pagado_eliminados'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.pagoseliminados'))
    @php $borde = config('app.color_c'); @endphp
    @break color_default
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus_pago">{{ __('Estatus pago') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('estatus_pago', $pedido->estat_pag, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>
--}}
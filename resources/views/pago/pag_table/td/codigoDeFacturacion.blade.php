<td>
  @if($show == true)
    @canany([$canany])
      <a href="{{ route($ruta, Crypt::encrypt($pago->id)) }}" title="Detalles: {{ $pago->cod_fact }}">{{ $pago->cod_fact }}</a>
    @else
      {{ $pago->cod_fact }}
    @endcanany
  @else
    {{ $pago->cod_fact }}
  @endif

  @if($pago->comp_de_pag_nom == null)
    <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante') }}</span>
  @endif
</td>
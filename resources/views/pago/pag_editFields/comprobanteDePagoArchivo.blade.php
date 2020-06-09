@if($pago->comp_de_pag_nom != null)
  <div class="col-md-5">
    <div class="pad box-pane-right no-padding" style="min-height:280px">
      <iframe src="{{ Storage::url($pago->comp_de_pag_rut.$pago->comp_de_pag_nom) }}" style="width:100%;border:none;height:20rem;"></iframe>
    </div>
  </div>
@else
<div class="col-md-5">
  <div class="pad box-pane-right no-padding border" style="min-height:280px">
    <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante') }}</span>
  </div>
</div>
@endif
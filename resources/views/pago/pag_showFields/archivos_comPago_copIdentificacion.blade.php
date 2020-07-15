<div class="row">
  @if($pago->comp_de_pag_nom != null)
    <div class="form-group col-sm btn-sm">
      <label for="comprobante_de_pago">{{ __('Comprobante de pago') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ Storage::url($pago->comp_de_pag_rut.$pago->comp_de_pag_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @else
    <div class="col-md-5">
      <div class="pad box-pane-right no-padding border" style="min-height:280px">
        <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante') }}</span>
      </div>
    </div>
  @endif
  @if($pago->cop_de_indent_nom != null)
    <div class="form-group col-sm btn-sm">
      <label for="copia_de_identificacion">{{ __('Copia de identificación') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ Storage::url($pago->cop_de_indent_rut.$pago->cop_de_indent_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
</div>
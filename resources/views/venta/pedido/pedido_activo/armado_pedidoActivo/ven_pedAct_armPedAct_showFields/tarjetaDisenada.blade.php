@if($armado->tarj_dise_nom != null)
  <div class="col-md-5">
    <div class="pad box-pane-right no-padding" style="min-height: 280px">
      <iframe src="{{ Storage::url($armado->tarj_dise_rut.$armado->tarj_dise_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
    </div>
  </div>
@endif
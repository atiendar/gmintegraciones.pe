<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($armado->img_nom != null)
        <img src="{{ Storage::url($armado->img_rut.$armado->img_nom) }}" class="profile-user-img img-fluid" alt="{{ $armado->img_nom }}">
      @endif
    </div>
  </div>
</div>
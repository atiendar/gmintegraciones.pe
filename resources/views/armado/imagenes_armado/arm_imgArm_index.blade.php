<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    @include('armado.imagenes_armado.arm_imgArm_create')
    <h5>
      <strong>{{ __('Galeria de imagenes') }}</strong>
    </h5>
  </div>
  <div class="card-body">
    @include('armado.imagenes_armado.arm_imgArm_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $imagenes->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $imagenes->firstItem() . ' ' . __('hasta') . ' '. $imagenes->lastItem() . ' ' . __('de') . ' '. $imagenes->total() . ' ' . __('registros') }}.
    </div>
  </div>
</div>
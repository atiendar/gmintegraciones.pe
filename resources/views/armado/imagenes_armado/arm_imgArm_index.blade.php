<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botto tex">
    @include('armado.imagenes_armado.arm_imgArm_create')
    <h5>
      <strong>{{ __('Galeria de imagenes') }}</strong>
    </h5>
  </div>
  <div class="card-body">
    @include('armado.imagenes_armado.arm_imgArm_table')
  </div>
</div>
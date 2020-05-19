<div class="card {{ empty($armado->cant == $armado->cant_direc_carg) ? 'card-danger' : 'card-info' }} card-outline">
  <div class="card-header p-1 border-botto">
      @if(Request::route()->getName() == 'cotizacion.armado.edit')
        <div class="float-right">
          <a href="{{ route('cotizacion.armado.direccion.create', Crypt::encrypt($armado->id)) }}" class="btn btn-primary">{{ __('Registrar dirección') }}</a>
        </div>
      @endif
    <h5>{{ __('Direcciones') }} ({{ $armado->cant_direc_carg }} {{ __('de') }} {{ $armado->cant }})</h5>
  </div>
  <div class="card-body">
    @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $direcciones->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $direcciones->firstItem() . ' ' . __('hasta') . ' '. $direcciones->lastItem() . ' ' . __('de') . ' '. $direcciones->total() . ' ' . __('registros') }}.
    </div>
  </div>
</div>
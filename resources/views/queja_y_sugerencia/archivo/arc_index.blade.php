<div class="card card-info card-outline">
  <div class="card-header p-1 border-botto">
    <h5>{{ __('Archivos') }}</h5> 
  </div>
  <div class="card-body">
    @include('queja_y_sugerencia.archivo.arc_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $archivos->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $archivos->firstItem() . ' ' . __('hasta') . ' '. $archivos->lastItem() . ' ' . __('de') . ' '. $archivos->total() . ' ' . __('registros') }}.
    </div>  
  </div>
</div>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($facturas) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          
        </tr>
      </thead>
      <tbody> 
        @foreach($facturas as $factura)
          <tr title="{{ $factura->id }}">
            
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
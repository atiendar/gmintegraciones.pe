<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>Archivos
    </h5>
  </div>
  <div class="card-body">
   @if(sizeof($archivos) == 0)
           @include('layouts.private.busquedaSinResultados')    
        @else 
      <table class="table-sm">
       <tbody> 
         @foreach ($archivos as $archivo)
           <tr title="{{ $archivo->id }}">
              <td>
                <a href="{{Storage::url($archivo->arc_rut.$archivo->arc_nom)}}" download title="Detalles: {{ $archivo->arc_nom}}" >{{$archivo->arc_nom}}</a>
              </td>
            </tr>
          @endforeach 
        </tbody>  
      </table>
      <div class="pt-2">
        <div style="float: right;">
          {!! $archivos->appends(Request::all())->links() !!}  
        </div>
        {{ __('Mostrando desde') . ' '. $archivos->firstItem() . ' ' . __('hasta') . ' '. $archivos->lastItem() . ' ' . __('de') . ' '. $archivos->total() . ' ' . __('registros') }}.
      </div>
    @endif
  </div>
</div>
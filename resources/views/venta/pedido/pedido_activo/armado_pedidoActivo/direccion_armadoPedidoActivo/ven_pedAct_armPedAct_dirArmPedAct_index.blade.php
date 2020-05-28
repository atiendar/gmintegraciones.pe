<div class="card {{ config('app.color_card_secundario') }} card-outline">
    <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
      <h5>{{ __('Direcciones') }}</h5> 
    </div>
    <div class="card-body">
 
        

      <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;"> 
        <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
          @if(sizeof($direcciones) == 0)
            @include('layouts.private.busquedaSinResultados')
          @else 
            <thead>
              <tr> 
                @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
                @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
                @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
                @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
                @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
                <th>{{ __('P. RECIBE') }}</th>
                <th>{{ __('COLONIA') }}</th>
                <th colspan="2">&nbsp</th>
              </tr>
            </thead>
            <tbody> 
              @foreach($direcciones as $direccion)
                <tr title="{{ $direccion->id }}">
                  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad')
                  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
                  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
                  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
                  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
                  <td>{{ $direccion->nom_ref_uno }}</td>
                  <td>{{ $direccion->col }}</td>
                </tr>
              @endforeach
            </tbody>
          @endif
        </table>
      </div>




      @include('global.paginador.paginador', ['paginar' => $direcciones]) 
    </div>
  </div>
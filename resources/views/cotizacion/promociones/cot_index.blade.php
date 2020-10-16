<div class="card card-info">
  <div class="card-header p-1 border-bottom bg-info">
    <h5>{{ __('PROMOCIONES QUE APLICAN PARA ESTA COTIZACIÓN') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 15em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
          <tbody>
              @include('cotizacion.promociones.cot_1cada50')
              @php 
                $cant_direcciones1 = 0;
                $cant_direcciones2 = 0;
                $cant_direcciones3 = 0;
                $cant_direcciones4 = 0;
              @endphp  
              @foreach($armados as $armado)
                @foreach($armado->direcciones as $direccion)
                  @include('cotizacion.promociones.cot_enviosCDMXyMetropolitano')
                  @include('cotizacion.promociones.cot_arribaDe20Mil')
                  @include('cotizacion.promociones.cot_arribaDe50Mil')
                  @include('cotizacion.promociones.cot_arribaDe70Mil')
                @endforeach
                @php
                  $cant_direcciones1 = 0;
                  $cant_direcciones2 = 0;
                  $cant_direcciones3 = 0;
                  $cant_direcciones4 = 0;
                @endphp  
              @endforeach
            </td>
          </tbody>
      </table>
    </div>
  </div>
</div>
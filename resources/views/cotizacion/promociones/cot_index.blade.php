<div class="card card-info">
  <div class="card-header p-1 border-bottom bg-info">
    <h5>{{ __('PROMOCIONES') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 15em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
          <tbody>
{{-- 
              @include('cotizacion.promociones.cot_1cada50')
              @php 
                $cant_direcciones = 0
              @endphp  
              @foreach($armados as $armado)
                @foreach($armado->direcciones as $direccion)
                  @include('cotizacion.promociones.cot_enviosCDMXyMetropolitano')
                @endforeach
                @php
                  $cant_direcciones = 0
                @endphp  
              @endforeach
            </td>
--}}

          </tbody>
      </table>
    </div>
  </div>
</div>

{{--
'Querétaro (Santiago de Querétaro)'
'Puebla (H. Puebla de Zaragoza)'
'Hidalgo (Pachuca de Soto)'
'Tlaxcala (Tlaxcala de Xicohténcatl)'
'Morelos (Cuernavaca)'
'México (Edo. México)'
----------
'Jalisco (Guadalajara)'
'Guanajuato (Guanajuato)'
'Guerrero (Chilpancingo de los Bravo)'
'Veracruz de Ignacio de la Llave (Xalapa de Enríquez)'
---------------------
'Nuevo León (Monterrey)'
'Tamaulipas (Ciudad Victoria)'
'Oaxaca (Oaxaca de Juárez)'
'Durango (Victoria de Durango)'
'San Luis Potosí (San Luis Potosí)'
'Colima (Colima)'
'Zacatecas (Zacatecas)'
--}}


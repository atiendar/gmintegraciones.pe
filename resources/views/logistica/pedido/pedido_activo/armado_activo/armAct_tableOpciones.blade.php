<td width="1rem" title="Editar: {{ $armado->id }}">
  @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
    @can('produccion.pedidoActivo.armado.edit')
      <a href="{{ route('logistica.pedidoActivoLocal.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Generar comprobante de entrega: {{ $armado->id }}">
  @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_ruta') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
    <a href="" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
  @endif
</td>
<td width="1rem" title="Carcar comprobante de entrega: {{ $armado->id }}">
  @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_ruta') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
    <a href="" class='btn btn-light btn-sm'><i class="fas fa-arrow-circle-up"></i></a>
  @endif
</td>
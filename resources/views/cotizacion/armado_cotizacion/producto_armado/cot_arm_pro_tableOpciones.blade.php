<td width="1rem" title="Eliminar: {{ $producto->sku }}">
  <form method="post" action="{{ route('cotizacion.armado.producto.destroy', Crypt::encrypt($producto->id)) }}" id="cotizacionArmadoProductoDestroy{{ $producto->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$producto->id", 'onclick' => "return check('btnsub$producto->id', 'cotizacionArmadoProductoDestroy$producto->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $producto->id ($producto->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>
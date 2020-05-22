<td>
  @can('cotizacion.show')
    <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" title="Detalles: {{ $cotizacion->serie }}">{{ $cotizacion->serie }}</a>
  @else
    {{ $cotizacion->serie }}
  @endcan
</td>
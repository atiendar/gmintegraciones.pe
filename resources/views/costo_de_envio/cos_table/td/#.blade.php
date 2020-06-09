<td>
  @can('costoDeEnvio.show')
    <a href="{{ route('costoDeEnvio.show', Crypt::encrypt($costo_de_envio->id)) }}" title="Detalles: {{ $costo_de_envio->id }}">{{ $costo_de_envio->id }}</a>
  @else
    {{ $costo_de_envio->id }}
  @endcan
</td>
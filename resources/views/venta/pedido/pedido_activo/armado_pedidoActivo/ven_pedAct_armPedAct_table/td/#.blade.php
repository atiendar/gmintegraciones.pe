<td>
  @if($show == true)
    @canany([$canany])
      <a href="{{ route($ruta, Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->cod }}">{{ $armado->cod }}</a>
    @else
      {{ $armado->cod }}
    @endcanany
  @else
    {{ $armado->cod }}
  @endif
</td>
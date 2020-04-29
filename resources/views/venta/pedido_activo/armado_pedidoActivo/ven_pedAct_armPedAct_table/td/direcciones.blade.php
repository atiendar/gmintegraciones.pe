<td>
  @foreach($armado->direcciones as $direccion)
    {{ $direccion->num_arm }} - {{ $direccion->nom_ref_uno }} ({{ $direccion->col }}) 
  @endforeach
</td>
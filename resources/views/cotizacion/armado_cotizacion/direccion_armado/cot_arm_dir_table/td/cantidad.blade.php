<td>
  {{ Sistema::dosDecimales($direccion->cant) }}
  @if($direccion->for_loc == 'Foráneo')
    <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i>
  @endif
</td>
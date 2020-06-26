@if($pedido->urg == 'Si')
  <i class="fas fa-exclamation-triangle" title="{{ __('Urgente') }}"></i>
@endif
@if($pedido->foraneo == 'Si')
  <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i>
@endif
@if($pedido->gratis == 'Si')
  <i class="fas fa-gift" title="{{ __('Gratis') }}"></i>
@endif
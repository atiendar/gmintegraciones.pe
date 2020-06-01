@if($pedido->entr_xprs == 'Si')
  <i class="fas fa-shipping-fast" title="{{ __('Entrega express') }}"></i>
@endif
@if($pedido->urg == 'Si')
  <i class="fas fa-exclamation-triangle" title="{{ __('Urgente') }}"></i>
@endif
@if($pedido->foraneo == 'Si')
  <i class="fas fa-globe-africa" title="{{ __('Foraáeo') }}"></i>
@endif
@if($pedido->gratis == 'Si')
  <i class="fas fa-gift" title="{{ __('Gratis') }}"></i>
@endif
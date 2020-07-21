<div class="float-right pr-5">
  @if(Request::route()->getName() != 'logistica.direccionLocal.show')
    @can('logistica.direccionLocal.createComprobanteDeSalida')
      <a href="{{ route('logistica.direccionLocal.show', Crypt::encrypt($direccion->id)) }}" class="btn btn-info btn-sm">{{ __('Detalles') }}</a>
    @endcan 
  @endif

  @if(Request::route()->getName() != 'logistica.direccionLocal.comprobanteDeSalida.create')
    @can('logistica.direccionLocal.comprobanteDeSalida.create')
      <a href="{{ route('logistica.direccionLocal.comprobanteDeSalida.create', Crypt::encrypt($direccion->id)) }}" class="btn btn-info btn-sm">{{ __('Registrar comprobante de salida') }}</a>
    @endcan 
  @endif

  @if(Request::route()->getName() != 'logistica.direccionLocal.comprobanteEntrega.index')
    @can('logistica.direccionLocal.comprobanteEntrega.index')
      <a href="{{ route('logistica.direccionLocal.comprobanteEntrega.index', Crypt::encrypt($direccion->id)) }}" class="btn btn-info btn-sm">{{ __('Registrar comprobante de entrega') }}</a>
    @endcan
  @endif
</div>
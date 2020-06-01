<div class="col-md-4">
  <div class="card {{ config('app.color_card_secundario') }} card-outline">
    <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
      <h5>{{ __('Pedido unificado') }}</h5> 
    </div>
    <div class="card-body">    
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="{{ $alto }}">
        <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
          @if(sizeof($unificados) == 0)
            @include('layouts.private.busquedaSinResultados')
          @else 
            <tbody> 
              @foreach($unificados as $unificado)
                <tr>
                  <td><a href="{{ route('venta.rastrearPedido.rastrear', Crypt::encrypt($pedido->id)) }}" target="_blank">{{ $unificado->num_pedido }}</a></td>
                </tr>
              @endforeach
            </tbody>
          @endif
        </table>
      </div>
      @include('global.paginador.paginador', ['paginar' => $unificados]) 
    </div>
  </div>
</div>
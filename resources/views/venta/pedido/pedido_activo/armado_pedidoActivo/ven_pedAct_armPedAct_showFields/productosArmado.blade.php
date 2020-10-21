<div class="row">
  <label for="productos">{{ __('Productos') }}</label>
  <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 30em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      <tbody> 
        @foreach($productos as $producto)
          <tr>
            <td>
              {{ $producto->cant }} -
              @if($producto->sustitutos()->sum('cant') == $producto->cant * $armado->cant)
                <del>{{ $producto->produc }}</del>
              @else
                @can('almacen.producto.show')
                  <a href="{{ route('almacen.producto.show', Crypt::encrypt($producto->id_producto)) }}" target="_blank">{{ $producto->produc }}</a>
                @else
                  {{ $producto->produc }}
                @endcan
              @endif
              @foreach($producto->sustitutos as $sustituto)
                <div class="input-group text-muted ml-4">
                  {{ $sustituto->cant }} -
                  @can('almacen.producto.show')
                    <a href="{{ route('almacen.producto.show', Crypt::encrypt($sustituto->id_producto)) }}" target="_blank">{{ $sustituto->produc }}</a>
                  @else
                    {{ $sustituto->produc }}
                  @endcan
                </div>
              @endforeach
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
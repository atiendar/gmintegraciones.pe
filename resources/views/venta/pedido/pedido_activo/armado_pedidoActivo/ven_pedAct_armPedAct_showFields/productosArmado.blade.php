<div class="row">
  <label for="productos">{{ __('Productos') }}</label>
  <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 30em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      <tbody> 
        @foreach($productos as $producto)
          <tr>
            <td>
              {{ $producto->cant }} - {{ $producto->produc }}
              @foreach($producto->sustitutos as $sustituto)
                <div class="input-group text-muted ml-4">
                  {{ $sustituto->cant }} - {{ $sustituto->produc }}
                </div>
              @endforeach
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
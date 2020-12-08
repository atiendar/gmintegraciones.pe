{{-- 
<table>
  <thead>
  <tr>
    <th>NOMBRE DEL PRODUCTO</th>
    <th>CANTIDAD</th>
  </tr>
  </thead>
  <tbody>
  @foreach($pedidos as $pedido)
    @foreach($pedido->armados as $armado)
      @foreach($armado->productos as $producto)
        <tr>
          <td>{{ $producto->produc }}</td>
          <td>
            {{ $producto->cant * $armado->cant  }}
          </td>
        </tr>
      @endforeach
    @endforeach
  @endforeach
  </tbody>
</table>
--}}


<table>
  <thead>
  <tr>
    <th>NOMBRE DEL PRODUCTO</th>
    <th>CANTIDAD</th>
  </tr>
  </thead>
  <tbody>
  @foreach($pedidos as $pedido)
  <tr>
    <td>{{ $pedido['nombre_producto'] }}</td>
    <td>{{ $pedido['cantidad'] }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
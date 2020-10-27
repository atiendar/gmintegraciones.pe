<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>NOMBRE DEL PRODUCTO</th>
    <th>PRECIO</th>
    <th>CANTIDAD VENDIDA</th>
    <th>STOCK</th>
    <th>EXISTENCIA EQUIVALENTE</th>
    <th>ARMADO</th>
  </tr>
  </thead>
  <tbody>
  @foreach($productos as $producto)
    <tr>
      <td>{{ $producto->id }}</td>
      <td>{{ $producto->produc }}</td>
      <td>{{ $producto->prec_clien }}</td>
      <td>{{ $producto->vend }}</td>
      <td>{{ $producto->stock }}</td>
      <td>
        @php $suma = 0 @endphp
        @foreach($producto->sustitutos as $sustituto)
          @php $suma += $sustituto->stock @endphp
        @endforeach
        {{ $suma }}
      </td>
      <td>
        @foreach($producto->productos_pedido as $producto_pedido)
          @if($producto_pedido->armado != null)
          ({{ $producto_pedido->armado->cod }}) - {{ $producto_pedido->armado->cant * $producto_pedido->cant }}<br>
          @endif
        @endforeach
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
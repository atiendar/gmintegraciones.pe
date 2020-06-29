<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Orden de producción {{ $pedido->num_pedido }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:10px;">
    <tr>
      <td colspan="2" style="text-align:center">
        <dt><img src="{{ substr(\Storage::url(Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg), 1)  }}" class="brand-image rounded elevation-0" style="width:10rem;"></dt>
        <dt><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></dt>
      </td>
      <td colspan="2">
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->emp }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}</dt>
      </td>
      <td colspan="8">
        <dt><h5>Orden de producción</h5></dt>
        <dt>{{ date("Y-m-d G:i:s") }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="1">
        <dt>Número de pedido</dt>
        <dt>{{ $pedido->num_pedido }}</dt>
      </td>
      <td colspan="6">
        <dt>Pedido unificado</dt>
        <dt>
          @foreach($pedido->unificar as $unificado)
            [{{ $unificado->num_pedido }}</a>] 
          @endforeach
        </dt>
      </td>
      <td colspan="5">
        <dt>Fecha de Entrega</dt>
        <dt>{{ $pedido->fech_de_entreg }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="8">
        <dt>Cliente</dt>
        <dt>{{ $pedido->usuario->nom }} ({{ $pedido->usuario->email_registro }})</dt>
      </td>
      <td colspan="4">
        <dt>Total de armados</dt>
        <dt>{{ $pedido->arm_carg }} de {{ $pedido->tot_de_arm }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="12">
        <dt>Comentarios generales ventas</dt>
        <dt>{{ $pedido->coment_venta }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="12">
        <dt>Comentarios generales cliente</dt>
        <dt>{{ $pedido->coment_client }}</dt>
      </td>
    </tr>
    <tr>
      <td colspan="1">
        <dt><h5>Líder de pedido</h5></dt>
      </td>
      <td colspan="11">
        <dt>Nombre completo:</dt>
        <dt>Fecha:</dt>
        <dt>Firma:</dt>
      </td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size:8px;">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>CANT</th>
          <th>TIPO</th>
          <th>ARMADO</th>
          <th>COM. VENTAS</th>
          <th>COM. CLIENTE</th>
        </tr>
      </thead>
      <tbody>
        @foreach($armados as $armado)
          <tr>
            <td>{{ $armado->cod }}</td>
            <td>{{ $armado->cant }}</td>
            <td>{{ $armado->tip }}</td>
            <td>
              <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
              @foreach($armado->productos as $producto)
                <div class="input-group text-muted ml-2">
                  <u>[{{ $producto->cant }} - {{ $producto->produc }}]</u>
                </div>
                @foreach($producto->sustitutos as $sustituto)
                  <div class="input-group text-muted ml-4">
                    {{ $sustituto->cant }} - {{ $sustituto->produc }}
                  </div>
                @endforeach
              @endforeach
            </td>
            <td>{{ $armado->coment_vent}}</td>
            <td>{{ $armado->coment_client }}</td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table> 
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cotización</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:10px;text-align:center;">
    <tr>
      <td colspan="2">
        <img src="{{ substr(\Storage::url(\App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg_rut . \App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg), 1)  }}" class="brand-image rounded elevation-0" style="width:10rem;">
      </td>
      <td colspan="3" style="text-align:right;">
        <strong style="font-size:13px;">
          {{ Sistema::datos()->sistemaFindOrFail()->pag }}
        </strong><br>
        {{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}<br>
        {{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}<br>
        {{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}<br>
      </td>
      <td colspan="5" style="vertical-align:text-top;text-align:right;font-size:20px;font-weight:bold;width: 200px;">
        Cotización {{ $cotizacion->serie }}
        <div style="vertical-align:text-bottom;text-align:right;font-size:8px;width: 200px;">
          Validez: {{ $cotizacion->valid }}
        <div>
      </td>
    </tr>
    <tr style="border-top:0.01rem solid #9C9C9C;border-bottom:0.01rem solid #9C9C9C">
      <td colspan="10"><strong>Cliente</strong> {{ $cotizacion->cliente->nom }} ({{ $cotizacion->cliente->email_registro }})<br></td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size: 8px;">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead class="thead-dark">
        <tr>
          <th>TIPO</th>
          <th>DESCRIPCIÓN</th>
          <th>CANT.</th>
          <th>PRECIO UNIT.</th>
          <th>COST. ENVIO</th>
          @if($cotizacion->desc > 0)
            <th>DESCUENTO</th>
          @endif
          <th>SUBTOTAL</th>
          <th>IVA</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr>
            <td>{{ $armado->tip }}</td>
            <td>
              <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
              @foreach($armado->productos as $producto)
                <div class="input-group text-muted ml-4">
                  {{ $producto->cant }} - {{ $producto->produc }}
                </div>
              @endforeach
            </td>
            <td>{{ Sistema::dosDecimales($armado->cant) }}</td>
            <td>${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
            <td>${{ Sistema::dosDecimales($armado->cost_env) }}</td>
            @if($cotizacion->desc > 0)
              <td>${{ Sistema::dosDecimales($armado->desc) }}</td>
            @endif
            <td>${{ Sistema::dosDecimales($armado->sub_total) }}</td>
            <td>${{ Sistema::dosDecimales($armado->iva) }}</td>
            <td>${{ Sistema::dosDecimales($armado->tot) }}</td>
          </tr>
          @endforeach
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="1">CANT. TOTAL</td>
            <td colspan="1">{{ Sistema::dosDecimales($cotizacion->tot_arm) }}</td>
          </tr>
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="1"> COST. ENVIO</td>
            <td colspan="1">${{ Sistema::dosDecimales($cotizacion->cost_env) }}</td>
          </tr>
          @if($cotizacion->desc > 0)
            <tr style="text-align:right;">
              <td colspan="6"></td>
              <th colspan="1"></td>
              <td colspan="1">DESCUENTO</td>
              <td colspan="1">${{ Sistema::dosDecimales($cotizacion->desc) }}</td>
            </tr>
          @endif
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="1">SUBTOTAL</td>
            <td colspan="1">${{ Sistema::dosDecimales($cotizacion->sub_total) }}</td>
          </tr>
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="1">IVA</td>
            <td colspan="1">${{ Sistema::dosDecimales($cotizacion->iva) }}</td>
          </tr>
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="1">TOTAL</td>
            <td colspan="1">${{ Sistema::dosDecimales($cotizacion->tot) }}</td>
          </tr>
      </tbody>
    @endif
  </table>
</body>
</html>
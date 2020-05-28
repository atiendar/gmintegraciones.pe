<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cotización {{ $cotizacion->serie }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:10px;">
    <tr>
      <td style="text-align:center">
        <dl>
          <dt><img src="{{ substr(\Storage::url(Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg), 1)  }}" class="brand-image rounded elevation-0" style="width:10rem;"></dt>
          <dt><strong><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></strong></dt>
          <dt>¡Fortalecemos tus Relaciones Comerciales!</dt>
        </dl>
      </td>
      <td>
        <dl>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->emp }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}</dt>
        </dl>
      </td>
      <td>
        <dl>
          <dt>{{ $cotizacion->serie }}</dt>
          <dt>Validez: {{ $cotizacion->valid }}</dt>
          <dt>Atención a: {{ $cotizacion->cliente->nom }} ({{ $cotizacion->cliente->email_registro }})</dt>
          <dt>Fecha de Cotización: {{ $cotizacion->created_at }}</dt>
        </dl>
      </td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size:8px;">
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
          <tr style="text-align:right;">
            <td colspan="6"></td>
            @if($cotizacion->desc > 0)
              <th colspan="1"></td>
            @endif
            <td colspan="2">
              @php $tot=$cotizacion->tot*0.0105 @endphp
              <a href="https://www.paypal.me/canastasyarconesmx/{{ Sistema::dosDecimales($cotizacion->tot + $tot) }}" target="_blank">Para pago con tarjeta clic aqui</a>
            </td>
          </tr>
      </tbody>
    @endif
  </table>
  @include('correo.'.Sistema::datos()->sistemaFindOrFail()->plant_cot_term_cond, ['nombre_de_la_empresa' => Sistema::datos()->sistemaFindOrFail()->emp])
</body>
</html>
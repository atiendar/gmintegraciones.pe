<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Comprobante de entrega {{ $comprobante->id }}</title>
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
        <h5>
          <dt>Comprobante de entrega</dt>
          <dt>{{ $armado->cod }}</dt>
        </h5>
        <dt>{{ date("Y-m-d G:i:s") }}</dt>
      </td>
    </tr>
    <tr style="font-size:15px;">
      <td colspan="12">
        <p>
          <strong>Nombre de referencia uno: </strong>{{ $direccion->nom_ref_uno }}<br>
          <strong>Nombre de referencia dos: </strong>{{ $direccion->nom_ref_dos }}<br>

          <strong>Teléfono fijo: </strong>({{ $direccion->lad_fij }}) {{ $direccion->tel_fij }} <strong>Ext.</strong> {{ $direccion->ext }},
          <strong>Teléfono móvil: </strong>({{ $direccion->lad_mov }}) {{ $direccion->tel_mov }}<br>

          <strong>C. </strong>{{ $direccion->calle }} 
          <strong>Nro.</strong> {{ $direccion->no_ext }} 
          <strong>int.</strong> {{ $direccion->no_int }},
          <strong>País</strong> {{ $direccion->pais }},
          <strong>Ciudad</strong> {{ $direccion->ciudad }},
          <strong>Colonia</strong> {{ $direccion->col }},
          <strong>Delegación o municipio </strong> {{ $direccion->del_o_munic }},
          <strong>C.P.</strong> {{ $direccion->cod_post }} <br>
          <strong>Referencias zona de entrega: </strong>{{ $direccion->ref_zon_de_entreg }}<br>
        </p>
      </td>
    </tr>

    <tr style="font-size:15px;">
      <td colspan="3" class="text-center">
        
        <dt><br><br><br><br>Firma quien entrega</dt>
      </td>
      <td colspan="9" class="text-center">
        <dt><br><br><br><br>Firma quien recibe</dt>
      </td>
    </tr>



   
    <tr>
      <td colspan="8" style="font-size:15px;">
        <dt class="text-center"><h5>Confirmo que recibo el pedido completo y en buenas condiciones</h5></dt>
        <dt>Nombre completo:</dt>
        <dt>Fecha:</dt>
        <dt>Total de productos recibidos:</dt>
        <dt>Comentarios:</dt>
      </td>
      <td colspan="4" class="text-center">
        <dt>Firma</dt>
        <br><br><br>
        <dt>Al firmar confirmo mi entera satisfacción del producto recibido</dt>
      </td>
    </tr>
    <tr>
      <td colspan="3" class="text-center">
        <p>Cargar comprobante de salida</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRDComprobanteDeSalida) !!} ">
      </td>
      <td colspan="9" class="text-center">
        <p>Cargar comprobante de entrega</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRDComprobanteDeEntrega) !!} ">
      </td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size:10px;">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>CANTIDAD</th>
        <th>PRODUCTO</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $armado->cod }}</td>
        <td>{{ $comprobante->cant }}</td>
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
      </tr>
    </tbody>
  </table> 
</body>
</html>
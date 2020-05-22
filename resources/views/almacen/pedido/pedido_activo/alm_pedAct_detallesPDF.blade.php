<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <header>
    <table style="font-size: 10px; text-align:center; border: 1px solid #525659" class="table table-sm table-bordered">
      <tr>
        <td colspan="2"> 
          <img src="{{ substr(\Storage::url(App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg_rut . \App\Models\Sistema::datos()->sistemaFindOrFail()->log_neg), 1) }}" class="brand-image rounded elevation-0" style="width:10rem;"> </td>
        <td colspan="2" style="text-align:right;">
          <strong style="font-size: 13px;">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</strong><br>
          {{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}<br>
          {{ Sistema::datos()->sistemaFindOrFail()->tel_fij . ' ext. ' . Sistema::datos()->sistemaFindOrFail()->ext }}<br>
          {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}<br>
        </td>
        <td colspan="1"></td>
        <td colspan="6" style="vertical-align:text-top;text-align:right;font-size:20px;font-weight:bold;width: 200px;">Orden de Producción Almacen <div style="vertical-align:text-bottom;text-align:right;font-size:8px;width: 200px;"><?php echo(date("Y-m-d G:i:s")); ?></div></td>
      </tr>
      <tr style="border-top:0.01rem solid #9C9C9C;border-bottom:0.01rem solid #9C9C9C ">
        <td colspan="1"><strong>Número de Pedido</strong><br>{{ $pedido->serie.'-'.$pedido->id }}</td>
        <td colspan="3"><strong>Número(s) de pedido(s) unificado(s)</strong><br>{{ $pedido->num_ped_unif }}</td>
        <td colspan="3"><strong>Fecha de Entrega</strong><br>{{ $pedido->fech_de_entreg }}</td>
        <td colspan="3"><strong>Total de armados</strong><br>{{ $pedido->arc_carg }} de {{ $pedido->tot_de_arc }}</td>
        <td colspan="1"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>Cliente</strong><br>{{ $pedido->usuario->nom . ' (' . $pedido->usuario->email_registro }})</td>
        <td colspan="9"><strong>Comentarios generales ventas</strong><br>{{ $pedido->coment_venta }}</td>
     </tr>
      <tr>
        <td colspan="11"><strong>Comentarios generales cliente</strong><br>{{ $pedido->coment_client }}</td>
      </tr>
      <tr>
        <td colspan="1" style="font-size: 15px;"><strong>Persona que recibe </strong></td>
        <td colspan="7" style="font-size: 10px; text-align: left;"><strong>Nombre completo:<br><br>Fecha:<br></strong></td>
        <td colspan="3" style="font-size: 10px;"><strong>Firma</strong></td>
     </tr>
    </table>
  </header>
  <section>
    <table class="table table-striped table-sm table-bordered" style="font-size: 10px;">
      <thead class="thead-dark">
        <tr>
          <th>{{ __('#') }}</th>
          <th>{{ __('CANT.') }}</th>
          <th>{{ __('ARMADO') }}</th>
          <th>{{ __('COM. VENTAS') }}</th>
          <th>{{ __('COM. CLIENTE') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pedido->armados as $armado)
          <tr>
            <td width="1rem">{{ $armado->id }}</td>
            <td width="1rem">{{ $armado->cant }}</td>
            <td>
              <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
              @foreach($armado->productos as $producto)
              <div class="input-group text-muted ml-4">
                {{ $producto->cant }} - {{ $producto->produc }}
              </div>
              @endforeach
            </td>
            <td>{{ $armado->coment_vent}}</td>
            <td>{{ $armado->coment_client }}</td>
          </tr>
        @endforeach
      </tbody>
    </table> 
  </section>
</body>
</html>
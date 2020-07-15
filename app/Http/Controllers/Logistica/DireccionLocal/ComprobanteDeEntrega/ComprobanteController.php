public function createComprobanteDeEntrega($id_direccion) {
    $direccion = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, ['comprobantes']);
    $comprobantes = $direccion->comprobantes()->paginate(99999999);
    return view('logistica.pedido.direccion_local.dirLoc_createComprobanteDeEntrega', compact('direccion', 'comprobantes'));
  }
  public function storeComprobanteDeEntrega(Request $request, $id_direccion) {
    dd('storeComprobanteDeEntrega');
 //   estat = config('app.entregado')
  }
  public function generarComprobanteDeEntrega($id_direccion){
    dd('generarComprobanteDeEntrega');
    $direccion               = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_direccion, ['armado']);

    $codigoQRDireccion = $this->generarQRRepo->pedido($direccion->id, 'logistica.pedidoActivo.armado.direccion.edit');

    $comprobante_de_entrega  = \PDF::loadView('logistica.pedido.pedido_activo.export.comprobanteDeEntrega', compact('direccion', 'codigoQRDireccion'));
    return $comprobante_de_entrega->stream();
//  return $orden_de_produccion->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
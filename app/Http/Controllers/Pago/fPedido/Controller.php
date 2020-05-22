public function store($id_pedido) {
  }
  public function show($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago);
    return view('pago.fPedido.pago.fpe_show', compact('pago'));
  }


  public function destroy($id_pago) {
    $this->pagoRepo->destroy($id_pago);
    toastr()->success('¡Pago eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
<?php
namespace App\Http\Controllers\Factura;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\factura\FacturaRepositories;

class FacturaController extends Controller {
  protected $facturaRepo;
  public function __construct(FacturaRepositories $facturaRepositories) {
    $this->facturaRepo    = $facturaRepositories;
  }
  public function index(Request $request) {
    $facturas = $this->facturaRepo->getPagination($request);
    return view('factura.fac_index', compact('facturas'));
  }
  public function create() {

  }
  public function store(Request $request) {

  }
  public function show($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFailById($id_factura, ['usuario', 'pago']);

    return view('factura.fac_show', compact('factura'));
  }
  public function edit($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFailById($id_factura, []);
    return view('factura.fac_edit', compact('factura'));
  }
  public function update(Request $request, $id_factura) {

  }
  public function destroy($id_factura) {

  }
}
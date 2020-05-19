<?php
namespace App\Http\Controllers\Pago;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\pago\PagoRepositories;

class PagoController extends Controller {
  protected $pagoRepo;
  public function __construct(PagoRepositories $pagoRepositories) { 
    $this->pagoRepo    = $pagoRepositories;
  }
  public function index(Request $request) {
    $pagos =  $this->pagoRepo->getPagination($request);
    return view('pago.pag_index', compact('pagos'));
  }
}
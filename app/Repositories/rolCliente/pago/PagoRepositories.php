<?php
namespace App\Repositories\rolCliente\pago;
// Models
use App\Models\Pago;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;

class PagoRepositories implements PagoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getAllCodigosFacturaClientePluck() {
    return Pago::where('user_id', Auth::user()->id)->where('est_fact', config('app.no_solicitada'))->whereYear('created_at', date('Y'))->orderBy('cod_fact', 'ASC')->pluck('cod_fact', 'cod_fact');
  }
  public function getPagination($request) {
    return Pago::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}
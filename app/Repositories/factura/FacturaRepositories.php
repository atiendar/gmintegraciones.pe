<?php
namespace App\Repositories\factura;
// Models
use App\Models\Factura;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class FacturaRepositories implements FacturaInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function getFacturaFindOrFailById($id_factura, $relaciones, $estatus) {
    $id_factura = $this->serviceCrypt->decrypt($id_factura);
    return Factura::with($relaciones)->estatus()->findOrFail($id_factura);
  }
  public function getPagination($request) {
    // falta ordenar por el estatus
    return Factura::with('usuario')->buscar($request->opcion_buscador, $request->buscador)->orderByRaw('est_fact DESC, id DESC')->paginate($request->paginador);
  }
}
<?php
namespace App\Repositories\cotizacion;
// Models
use App\Models\Cotizacion;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otro
use Illuminate\Support\Facades\Auth;
use DB;

class CotizacionRepositories implements CotizacionInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $serieRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, SerieRepositories $serieRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    $this->serieRepo                  = $serieRepositories;
  } 
  public function cotizacionAsignadoFindOrFailById($id_cotizacion) {
    $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
    $cotizacion = Cotizacion::with('armados')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_cotizacion);
    return $cotizacion;
  }
  public function getPagination($request) {
    return Cotizacion::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $arcon = new Cotizacion();
      $arcon->serie           = $this->serieRepo->sumaUnoALaUltimaSerie('Cotizaciones (Serie)', $request->serie);
      $arcon->valid           = $request->validez;
      $arcon->email_cliente   = $request->correo_del_cliente;
      $arcon->asignado_cot    = Auth::user()->email_registro;
      $arcon->created_at_cot  = Auth::user()->email_registro;
      $arcon->save();     
      DB::commit();
      return $arcon;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllCotizacionesValidasPlunk() {
    $dia_actual = date("Y-m-d");
    return Cotizacion::orderBy('id', 'ASC')->where('valid', '>=', $dia_actual)->pluck('serie', 'id');
  }
  public function getCotizacionFindOrFail($id_cotizacion) {
    $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
    $cotizacion = Cotizacion::with('armados')->findOrFail($id_cotizacion);
    return $cotizacion;
  }
}
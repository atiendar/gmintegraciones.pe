<?php
namespace App\Repositories\rolCliente\datoFiscal;
// Models
use App\Models\DatoFiscal;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DatoFiscalRepositories implements DatoFiscalInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function store($request) {
    try { DB::beginTransaction();
      $dato_fiscal = new DatoFiscal();
      $dato_fiscal = $this->storeFields($dato_fiscal, $request, Auth::user()->id);
      dd(   $dato_fiscal    );
      $dato_fiscal->save();
      DB::commit();
      return $dato_fiscal;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeFields($dato_fiscal, $request, $user_id) {
    $dato_fiscal->nom_o_raz_soc       = $request->nombre_o_razon_social;
    $dato_fiscal->rfc                 = $request->rfc;
    $dato_fiscal->lad_fij             = $request->lada_telefono_fijo;
    $dato_fiscal->tel_fij             = $request->telefono_fijo;
    $dato_fiscal->ext                 = $request->extension;
    $dato_fiscal->lad_mov             = $request->lada_telefono_movil;
    $dato_fiscal->tel_mov             = $request->telefono_movil;
    $dato_fiscal->calle               = $request->calle;
    $dato_fiscal->no_ext              = $request->no_exterior;
    $dato_fiscal->no_int              = $request->no_interior;
    $dato_fiscal->pais                = $request->pais;
    $dato_fiscal->ciudad              = $request->ciudad;
    $dato_fiscal->col                 = $request->colonia;
    $dato_fiscal->del_o_munic         = $request->delegacion_o_municipio;
    $dato_fiscal->cod_post            = $request->codigo_postal;
    $dato_fiscal->user_id             = $user_id;
    $dato_fiscal->created_at_dat_fisc = Auth::user()->email_registro;
    return $dato_fiscal;
  }
  public function getDatoFiscalFindOrFail($id_dato_fiscal, $relaciones) {
    $id_dato_fiscal = $this->serviceCrypt->decrypt($id_dato_fiscal);
    return DatoFiscal::with($relaciones)->findOrFail($id_dato_fiscal);
  }
}
<?php
namespace App\Repositories\rolCliente\direccion;
// Models
use App\Models\Direccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionRepositories implements DireccionInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function store($request) {
    try { DB::beginTransaction();
      $direccion = new Direccion();
      $direccion = $this->storeFields($direccion, $request, Auth::user()->id);
      dd(   $direccion    );
      $direccion->save();
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeFields($direccion, $request, $user_id) {
    $direccion->nom_ref_uno         = $request->nombre_de_referencia_uno;
    $direccion->nom_ref_dos         = $request->nombre_de_referencia_dos;
    $direccion->lad_fij             = $request->lada_telefono_fijo;
    $direccion->tel_fij             = $request->telefono_fijo;
    $direccion->ext                 = $request->extension;
    $direccion->lad_mov             = $request->lada_telefono_movil;
    $direccion->tel_mov             = $request->telefono_movil;
    $direccion->calle               = $request->calle;
    $direccion->no_ext              = $request->no_exterior;
    $direccion->no_int              = $request->no_interior;
    $direccion->pais                = $request->pais;
    $direccion->ciudad              = $request->ciudad;
    $direccion->col                 = $request->colonia;
    $direccion->del_o_munic         = $request->delegacion_o_municipio;
    $direccion->cod_post            = $request->codigo_postal;
    $direccion->ref_zon_de_entreg   = $request->referencias_zona_de_entrega;
    $direccion->user_id             = $user_id;
    $direccion->created_at_direc    = Auth::user()->email_registro;
    return $direccion;
  }
  public function getDireccionFindOrFail($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    return Direccion::with($relaciones)->findOrFail($id_direccion);
  }
}
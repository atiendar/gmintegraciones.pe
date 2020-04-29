<?php
namespace App\Repositories\proveedor;
// Models
use App\Models\Proveedor;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use DB;

class ProveedorRepositories implements ProveedorInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  }
  public function proveedorAsignadoFindOrFailById($id_proveedor) {
    $id_proveedor = $this->serviceCrypt->decrypt($id_proveedor);
    $proveedor = Proveedor::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->with('contactos', 'productos')->findOrFail($id_proveedor);
    return $proveedor;
  }
  public function getPagination($request) {
    return Proveedor::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $proveedor                  = new Proveedor();
      $proveedor->raz_soc         = $request->razon_social;
      $proveedor->nom_comerc      = $request->nombre_comercial;
      $proveedor->fab_distri      = $request->fabricante_distribuidor;
      $proveedor->rfc             = $request->rfc;
      $proveedor->nom_rep_legal   = $request->nombre_del_representante_legal;
      $proveedor->pag_web         = $request->pagina_web;
      $proveedor->lad_fij         = $request->lada_telefono_fijo;
      $proveedor->tel_fij         = $request->telefono_fijo;
      $proveedor->ext             = $request->extension;
      $proveedor->lad_mov         = $request->lada_telefono_movil;
      $proveedor->tel_mov         = $request->telefono_movil;
      $proveedor->obs             = $request->observaciones;
      $proveedor->call            = $request->calle;
      $proveedor->no_ext          = $request->no_ext;
      $proveedor->no_int          = $request->no_int;
      $proveedor->pais            = $request->pais;
      $proveedor->ciudad          = $request->ciudad;
      $proveedor->col             = $request->colonia;
      $proveedor->del_o_munic     = $request->delegacion_o_municipio;
      $proveedor->cod_post        = $request->codigo_postal;
      $proveedor->ref             = $request->referencias;
      $proveedor->asignado_prov   = Auth::user()->email_registro;
      $proveedor->created_at_prov = Auth::user()->email_registro;
      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'public/proveedor/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'proveedor-' . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $proveedor->arch_rut  = $archivo[0]['ruta'];
        $proveedor->arch_nom  = $archivo[0]['nombre'];
      }
      $proveedor->save();
      $this->eliminarCacheAllProveedoresPlunk();
      return $proveedor;
    });
  }
  public function update($request, $id_proveedor) {
    DB::transaction(function() use($request, $id_proveedor) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $proveedor = $this->proveedorAsignadoFindOrFailById($id_proveedor);
      $proveedor->raz_soc         = $request->razon_social;
      $proveedor->nom_comerc      = $request->nombre_comercial;
      $proveedor->fab_distri      = $request->fabricante_distribuidor;
      $proveedor->rfc             = $request->rfc;
      $proveedor->nom_rep_legal   = $request->nombre_del_representante_legal;
      $proveedor->pag_web         = $request->pagina_web;
      $proveedor->lad_fij         = $request->lada_telefono_fijo;
      $proveedor->tel_fij         = $request->telefono_fijo;
      $proveedor->ext             = $request->extension;
      $proveedor->lad_mov         = $request->lada_telefono_movil;
      $proveedor->tel_mov         = $request->telefono_movil;
      $proveedor->obs             = $request->observaciones;
      $proveedor->call            = $request->calle;
      $proveedor->no_ext          = $request->no_ext;
      $proveedor->no_int          = $request->no_int;
      $proveedor->pais            = $request->pais;
      $proveedor->ciudad          = $request->ciudad;
      $proveedor->col             = $request->colonia;
      $proveedor->del_o_munic     = $request->delegacion_o_municipio;
      $proveedor->cod_post        = $request->codigo_postal;
      $proveedor->ref             = $request->referencias;
      if($proveedor->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Proveedores', // Módulo
          'proveedor.show', // Nombre de la ruta
          $id_proveedor, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_proveedor), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Razón social', 'Nombre comercial', 'Fabricante / Distribuidor', 'RFC', 'Nombre del representante legal', 'Página web', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Observaciones', 'Calle', 'No. Ext.', 'No. Int.', 'Pais', 'Ciudad', 'Colonia', 'Delegación o municipio', 'Código postal', 'Referencias'), // Nombre de los inputs del formulario
          $proveedor, // Request
          array('raz_soc', 'nom_comerc', 'fab_distri', 'rfc', 'nom_rep_legal', 'pag_web', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'obs', 'call', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref') // Nombre de los campos en la BD
        ); 
        $proveedor->updated_at_prov = Auth::user()->email_registro;
      }
      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'public/proveedor/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'proveedor-' . time() . '.', // Nombre del archivo
          $proveedor->arch_rut.$proveedor->arch_nom // Ruta y nombre del archivo anterior
        ); 
        $proveedor->arch_rut  = $archivo[0]['ruta'];
        $proveedor->arch_nom  = $archivo[0]['nombre'];
      }
      if($proveedor->getOriginal('nom_comerc') != $request->nombre_comercial) {
        $this->cambiarNombreDelProvedorALosProductos($proveedor, $request->nombre_comercial);
      };
      $proveedor->save();
      $this->eliminarCacheAllProveedoresPlunk();
      return $proveedor;
    });
  }
  public function destroy($id_proveedor) {
    try { DB::beginTransaction();
      $proveedor = $this->proveedorAsignadoFindOrFailById($id_proveedor);
      $proveedor->delete();
      $this->eliminarCacheAllProveedoresPlunk();

      // Elimina todos los contactos relacionados al proveedor
      $contactos = $proveedor->contactos()->get();
      if($contactos->isEmpty() == false) { // Verifica si la colección esta vacia
        $hastaC = count($contactos) - 1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) { 
          $contactos_id[$contador2] = $contactos[$contador2]->id;        
        }
        \App\Models\ContactoProveedor::destroy($contactos_id);
      }

      /// Elimina todos los productos relacionados al proveedor
      $hastaC = count($proveedor->productos) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $proveedor->productos[$contador2]->prove      = null;
        $proveedor->productos[$contador2]->prec_prove = null;
        $proveedor->productos[$contador2]->utilid     = null;
        $proveedor->productos[$contador2]->prec_clien = null;
        $proveedor->productos[$contador2]->save();
      }

      // Manda el registro a la papelera de reciclaje
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Proveedores', // Nombre del módulo del sistema
        'registro'    => $proveedor->nom_comerc, // Información a mostrar en la papelera
        'tab'         => 'proveedores', // Nombre de la tabla en la BD
        'id_reg'      => $proveedor->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación              
      ]);
      DB::commit();
      return $proveedor;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllProveedoresPlunk() {
    $proveedores = Cache::rememberForever('allProveedoresPlunk', function() { // Guarda la información en la cache con la llave "allProveedoresPlunk"
      return Proveedor::orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'nom_comerc');
    });
    return $proveedores; 
  }
  public function getAllProveedoresPlunkMenos($proveedores) {
    return Proveedor::where(function($query) use($proveedores) {
      $hastaC = count($proveedores) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $proveedores[$contador2]->id);
      }
    })->orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'id');
  }
  public function eliminarCacheAllProveedoresPlunk() {
    Cache::pull('allProveedoresPlunk'); // Elimina la cache con el nombre espesificado
  }
  public function proveedorFindOrFailById($id_proveedor) {
    $id_proveedor = $this->serviceCrypt->decrypt($id_proveedor);
    $proveedor = Proveedor::findOrFail($id_proveedor);
    return $proveedor;
  }
  public function getContactosProveedor($proveedor, $request) {
    if($request->opcion_buscador != null) {
      return $proveedor->contactos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $proveedor->contactos()->paginate($request->paginador);
  }
  public function cambiarNombreDelProvedorALosProductos($proveedor, $nuevo_nombre_comercial) {
    $hastaC = count($proveedor->productos) - 1;
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $proveedor->productos[$contador2]->prove = $nuevo_nombre_comercial;
      $proveedor->productos[$contador2]->save();
    }
  }
}
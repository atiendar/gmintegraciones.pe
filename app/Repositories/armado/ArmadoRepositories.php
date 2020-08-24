<?php
namespace App\Repositories\armado;
// Models
use App\Models\Armado;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoRepositories implements ArmadoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $calculoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, CalculoRepositories $calculoRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->calculoRepo              = $calculoRepositories;
  }
  public function armadoAsignadoFindOrFailById($id_armado, $clon, $relaciones = null) { // 'productos', 'imagenes'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = Armado::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where('clon', $clon)->with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
  public function getPagination($request, $clon) {
    return Armado::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where('clon', $clon)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $armado = new Armado();
      $armado->clon            = '0'; // 1=Si
      $armado->tip             = $request->tipo;
      $armado->nom             = $request->nombre;
      $armado->sku             = $request->sku;
      $armado->gama            = $request->gama;
      $armado->dest            = $request->destacado;
      $armado->url_pagina      = $request->url_pagina;
      $armado->obs             = $request->observaciones;
      $armado->asignado_arm    = Auth::user()->email_registro;
      $armado->created_at_arm  = Auth::user()->email_registro;
      if($request->hasfile('imagen_del_armado')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen_del_armado'), // Archivo blob
          'armados/'.date("Y"), // Ruta en la que guardara el archivo
          'armado-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $armado->img_rut = $imagen[0]['ruta'];
        $armado->img_nom = $imagen[0]['nombre'];
      }
      $armado->save();
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_armado, $clon) {
    DB::transaction(function() use($request, $id_armado, $clon) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado = $this->armadoAsignadoFindOrFailById($id_armado, $clon, []);
      $armado->tip         = $request->tipo;
      $armado->nom         = $request->nombre;
      $armado->sku         = $request->sku;
      $armado->gama        = $request->gama;
      $armado->dest        = $request->destacado;
      $armado->url_pagina  = $request->url_pagina;
      $armado->obs         = $request->observaciones;
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        if($clon == '0') {
          $modulo = 'Armados';
          $nom_ruta = 'armado.show';
        }elseif($clon == '1') {
          $modulo = 'Armados clonados';
          $nom_ruta = 'armado.clon.show';
        }
        ActividadRegistrada::dispatch(
          $modulo, // Módulo
          $nom_ruta, // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_armado), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Tipo', 'Nombre', 'SKU', 'Gama', 'Destacado', 'URL página', 'Observaciones'), // Nombre de los inputs del formulario
          $armado, // Request
          array('tip', 'nom', 'sku', 'gama', 'dest', 'url_pagina', 'obs') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_arm  = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen_del_armado')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen_del_armado'), 
          'armados/'.date("Y"), 
          'armado-'.time().'.',
          $armado->img_nom
        ); 
        $armado->img_rut = $imagen[0]['ruta'];
        $armado->img_nom = $imagen[0]['nombre'];
      }
      $armado->save();
      return $armado;
    });
  }
  public function destroy($id_armado, $clon) {
    try { DB::beginTransaction();
      $armado = $this->armadoAsignadoFindOrFailById($id_armado, $clon, []);
      $armado->delete();
      if($clon == '0') {
        $modulo = 'Armados';
      }elseif($clon == '1') {
        $modulo = 'Armados clonados';
      }
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => $modulo, // Nombre del módulo del sistema
        'registro'    => $armado->nom , // Información a mostrar en la papelera
        'tab'         => 'armados', // Nombre de la tabla en la BD
        'id_reg'      => $armado->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosFindOrFail($ids_armados, $hastaC) {
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $armados[$contador2] = Armado::where('id', $ids_armados[$contador2])->first();
    }
    return $armados;
  }
  public function getProductosProveedor($armado, $request) {
    if($request->opcion_buscador != null) {
      return $armado->productos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $armado->productos()->paginate($request->paginador);
  }
  public function getImagenesArmado($armado) {
    return $armado->imagenes()->paginate(99999999);
  }
  public function getArmadoFindOrFail($id_armado) {
    return Armado::with('productos')->findOrFail($id_armado);
  }
  public function getAllArmadosPlunk() {
    return Armado::orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
  public function getAllArmadosPlunkMenos($armados) {
    return Armado::where(function($query) use($armados) {
      $hastaC = count($armados) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $armados[$contador2]->id_armado);
      }
    })->orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
}
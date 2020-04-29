<?php
namespace App\Repositories\papeleraDeReciclaje;
// Models
use App\Models\PapeleraDeReciclaje;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\servicio\fOpen\ServiceFopen;
// Repositories
use App\Repositories\proveedor\ProveedorRepositories;
// Events
use App\Events\layouts\ArchivosEliminados;
//Otro
use Illuminate\Support\Facades\Auth;
use DB;

class PapeleraDeReciclajeRepositories implements PapeleraDeReciclajeInterface {
  protected $serviceCrypt;
  protected $serviceFopen;
  public function __construct(ServiceCrypt $serviceCrypt, ServiceFopen $serviceFopen) {
    $this->serviceCrypt = $serviceCrypt;
    $this->serviceFopen = $serviceFopen;
  }
  public function papeleraAsignadoFindOrFailById($id_registro) {
    $id_registro = $this->serviceCrypt->decrypt($id_registro);
    $registro = PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_registro);
    return $registro;
  }
  public function getPagination($request) {
    return PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($array) {
    $papelera = new PapeleraDeReciclaje();
    $papelera->mod            = $array['modulo'];
    $papelera->reg            = $array['registro'];
    $papelera->tab            = $array['tab'];
    $papelera->id_reg         = $array['id_reg'];
    $papelera->id_fk          = $array['id_fk'];
    $papelera->deleted_at_reg = Auth::user()->email_registro;
    $papelera->save();
    return $papelera;
  }
  public function destroy($id_registro) {
    try { DB::beginTransaction();
      $registro   = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado  = $this->tablas($registro, 'destroy');
      $resultado['consulta']->forceDelete();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function restore($id_registro) {
    try { DB::beginTransaction();
      $registro = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado = $this->tablas($registro, 'restore');
      if($resultado['existe_llave_primaria'] == false) { DB::commit();return false; }
      $resultado['consulta']->restore();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function tablas($registro, $metodo) {
    $existe_llave_primaria = 'indefinido';
    if($registro->tab == 'users') {
      $consulta = \App\User::withTrashed()->findOrFail($registro->id_reg);
      if($metodo == 'destroy') {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ArchivosEliminados::dispatch(
          array($consulta->img_us_rut.$consulta->img_us), 
        );
      }
    }
    if($registro->tab == 'roles') {
      $consulta = \Spatie\Permission\Models\Role::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'plantillas') {
      $consulta = \App\Models\Plantilla::withTrashed()->findOrFail($registro->id_reg);
      if($metodo == 'destroy') {
        $this->serviceFopen->eliminarFicheroBlade('resources\views\correo\\' . $consulta->id . '.blade.php');
      }
    }
    if($registro->tab == 'catalogos') {
      $consulta = \App\Models\Catalogo::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'series') {
      $consulta = \App\Models\Serie::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'proveedores') {
      $consulta = \App\Models\Proveedor::with('productos')->withTrashed()->findOrFail($registro->id_reg);
      if($metodo == 'destroy') {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ArchivosEliminados::dispatch(
          array($consulta->arch_rut.$consulta->arch_nom), 
        );
      } 
      elseif($metodo == 'restore') {
        $consulta->contactos()->restore();
      }
    }
    if($registro->tab == 'contactos_proveedores') {
      $consulta = \App\Models\ContactoProveedor::with('proveedor')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->proveedor == null) {
        $existe_llave_primaria = false;
      }
    }
    if($registro->tab == 'armados') {
      $consulta = \App\Models\Armado::with('imagenes')->withTrashed()->findOrFail($registro->id_reg);
      if($metodo == 'destroy') {
        // Elimina todas las imagenes relacionadas a este registro
        $hastaC = count($consulta->imagenes) - 1;
        $imagenes = [];
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $imagenes[$contador2] = $consulta->imagenes[$contador2]->img_rut.$consulta->imagenes[$contador2]->img_nom;
        }
        if($consulta->img_nom != null) { array_push($imagenes, $consulta->img_rut.$consulta->img_nom); }
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ArchivosEliminados::dispatch(
          $imagenes, 
        );
      } 
    }
    if($registro->tab == 'productos') {
      $consulta = \App\Models\Producto::withTrashed()->findOrFail($registro->id_reg);
      if($metodo == 'destroy') {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ArchivosEliminados::dispatch(
          array($consulta->img_prod_rut.$consulta->img_prod_nom), 
        );
      }
    }
    return [
      'consulta'              => $consulta,
      'existe_llave_primaria' => $existe_llave_primaria
    ];
  }
  public function destroyAllPapeleraByIdFk($id_registro, $id_resultado) {
    $registros =  PapeleraDeReciclaje::where('id_fk', $id_resultado)->get();
    if($registros->isEmpty() == false) { // Verifica si la colección esta vacia
      $hastaC = count($registros) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) { 
        $registros_id[$contador2] = $registros[$contador2]->id;        
      }
      array_push($registros_id, $id_registro);
    } else {
      $registros_id[0] = $id_registro;
    }
    PapeleraDeReciclaje::destroy($registros_id); 
  }
}
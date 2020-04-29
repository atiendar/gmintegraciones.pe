<?php
namespace App\Repositories\rol\permiso;
// Models
use Spatie\Permission\Models\Permission;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PermisoRepositories implements PermisoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt   = $serviceCrypt;
  } 
  public function rolFindOrFailById($id_permiso) {
    $id_permiso = $this->serviceCrypt->decrypt($id_permiso);
    return Permission::findOrFail($id_permiso);
  }
  public function getPagination($request) {
    return Permission::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function getAllPermissionsPluck() {
    return Permission::orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
}
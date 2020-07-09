<?php
namespace App\Repositories\metodoDeEntrega;
// Models
use App\Models\MetodoDeEntrega;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class MetodoDeEntregaRepositories implements MetodoDeEntregaInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function metodoFindOrFailById($id_metodo, $relaciones = null) { //'contactos', 'productos'
    $id_metodo = $this->serviceCrypt->decrypt($id_metodo);
    $metodo = MetodoDeEntrega::with($relaciones)->findOrFail($id_metodo);
    return $metodo;
  }
  public function getAllMetodosPluck() {
    return MetodoDeEntrega::orderBy('nom_met_ent', 'ASC')->pluck('nom_met_ent', 'id');
  }
}
<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo;
//Models
use App\Models\InventarioEquipo;
//Events
use App\Events\layouts\ActividadRegistrada;
use App\Models\Catalogo;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class InventarioEquipoRepositories implements InventarioEquipoInterface {
    protected $serviceCrypt;
    protected $papeleraDeReciclajeRepo;
    public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
      $this->serviceCrypt               = $serviceCrypt;
      $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    }
  public function getAllInventarioEquiposPlunk() {
    return InventarioEquipo::orderBy('id', 'ASC')->pluck('id', 'id');
    }
}
<?php 
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario;
//Models
use App\Models\Historial;
//Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
//Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
//Events
use App\Events\layouts\ActividadRegistrada;
//Otros
use Illuminate\Support\Facades\Auth;
use DB;

class HistorialInvRepositories implements HistorialInvInterface {
    protected $serviceCrypt;
    protected $papeleraDeReciclajeRepo;
    public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
        $this->serviceCrypt             = $serviceCrypt;
        $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    }
    public function historialFindOrFailById($id_historial) {
        $id_historial = $this->serviceCrypt->decrypt($id_historial);
        return Historial::with('equipo')->findOrFail($id_historial);
    }
}
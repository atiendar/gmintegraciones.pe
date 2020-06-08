<?php
namespace App\Repositories\tecnologiaDeLainformacion\historial;
// Models
use App\Models\Historial;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use DB;

class historialRepositories implements  historialInterface{   
        protected $serviceCrypt;
        protected $papeleraDeReciclajeRepo;
        public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
            $this->serviceCrypt = $serviceCrypt;
            $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;    
        }
    public function store($request) {
        DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
        $historial                          = new Historial();
        $historial->sol                     = $request->nombre_del_solicitante;
        $historial->area_dep                = $request->area_departamento;
        $historial->tec                     = $request->nombre_del_tecnico;
        $historial->inventario_equipo_id    = $request->id_inventario;
        $historial->grup_de_falla           = $request->agrupacion_de_fallas;
        $historial->solu                    = $request->solucion;
        $historial->obs_del_equipo          = $request->observaciones_del_equipo;
        $historial->des_de_la_falla         = $request->descripcion_de_la_falla;
        $historial->created_at_his          = Auth::user()->email_registro;  
        $historial->save();
        return $historial;
      });
    }
}
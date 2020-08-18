<?php
namespace App\Http\Controllers\TecnologiaDeLaInformacion;
use App\Http\Controllers\Controller;
//Request
use Illuminate\Http\Request;
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\InventarioEquipoRepositories;
use App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo\UpdateInventarioEquipoRequest;
use App\Http\Request\tecnologiaDeLaInformacion\inventarioEquipo\StoreInventarioEquipoRequest;
use App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo\StoreInventarioEquipoRequest as InventarioEquipoStoreInventarioEquipoRequest;
use Doctrine\DBAL\Exception\RetryableException;

class InventarioEquipoController extends Controller{
    protected $inventarioEquipoRepo;
    public function __construct(InventarioEquipoRepositories $inventarioEquipoRepositories) {
            $this->inventarioEquipoRepo = $inventarioEquipoRepositories;
    }
    public function index(Request $request) {
        $inventarios = $this->inventarioEquipoRepo->getPagination($request);
        return view('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_index', compact('inventarios'));    
    }
    public function create()
    {
        return view('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_create');
    }
    public function store(InventarioEquipoStoreInventarioEquipoRequest $request) {
        $this->inventarioEquipoRepo->store($request);   
        toastr()->success('Inventario Registrado exitosamente');
        return back();
    } 
    public function show(Request $request, $id_inventario) {
        $inventario = $this->inventarioEquipoRepo->inventarioFindOrFailById($id_inventario);
        $archivos = $this->inventarioEquipoRepo->getArchivosInventario($inventario);
        $historiales = $this->inventarioEquipoRepo->getHistorialesInventario($inventario, $request);
        return view('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_show', compact('inventario', 'archivos', 'historiales'));
    }
    public function edit(Request $request, $id_inventario) {
        $inventario = $this->inventarioEquipoRepo->inventarioFindOrFailById($id_inventario);
        $archivos = $this->inventarioEquipoRepo->getArchivosInventario($inventario);
        $historiales = $this->inventarioEquipoRepo->getHistorialesInventario($inventario, $request);
        return view('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_edit', compact('inventario', 'archivos', 'historiales'));
    }
    public function update(UpdateInventarioEquipoRequest $request, $id_inventario) {
        $this->inventarioEquipoRepo->update($request, $id_inventario);
        toastr()->success('¡Inventario actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
        return back();
    }
    public function destroy($id_inventario) {
        $this->inventarioEquipoRepo->destroy($id_inventario);
        toastr()->success('¡Inventario eliminado exitosamente!');
        return back();
    }
}

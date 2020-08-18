<?php

namespace App\Http\Controllers\TecnologiaDeLaInformacion;
use App\Http\Controllers\Controller;
//Request
use Illuminate\Http\Request;
//Repositories
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\InventarioEquipoRepositories;
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario\HistorialInvRepositories;

class HistorialController extends Controller
{
    protected $inventarioEquipoRepo;
    protected $historialRepo;
    public function __construct(InventarioEquipoRepositories $inventarioEquipoRepositories, HistorialInvRepositories $historialInvRepositories){
        $this->inventarioEquipoRepo = $inventarioEquipoRepositories;
        $this->historialRepo        = $historialInvRepositories;
    } 
    public function index()
    {
        //
    }
    public function create($id_inventario) {
        $inventario = $this->inventarioEquipoRepo->inventarioFindOrFailById($id_inventario);
        return view('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_create', compact('inventario'));
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_historial) {
        $historial = $this->historialRepo->historialFindOrFailById($id_historial);
        $archivos = $historial->historialarchivos()->paginate(99999999);
        return view('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_show', compact('historial', 'archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

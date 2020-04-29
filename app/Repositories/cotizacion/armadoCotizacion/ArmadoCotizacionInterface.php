<?php
namespace App\Repositories\cotizacion\armadoCotizacion;

interface ArmadoCotizacionInterface {
    public function store($request, $id_cotizacion);

    public function destroy($id_armado);
}
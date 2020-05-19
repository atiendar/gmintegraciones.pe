<?php
namespace App\Repositories\cotizacion;

interface CotizacionInterface {
    public function cotizacionAsignadoFindOrFailById($id_cotizacion, $relaciones, $estatus);

    public function getPagination($request);

    public function store($request);

    public function destroy($id_cotizacion);

    public function getAllCotizacionesValidasPlunk();

    public function getCotizacionFindOrFail($id_cotizacion);
}
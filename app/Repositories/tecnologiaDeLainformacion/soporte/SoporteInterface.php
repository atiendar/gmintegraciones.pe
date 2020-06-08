<?php
namespace App\Repositories\tecnologiaDeLainformacion\soporte;

interface SoporteInterface {
    public function soporteFindOrFailById($id_soporte);
    public function getPagination($request);
    public function update($request, $id_soporte);
    public function store($request);
    public function destroy($id_soporte);
}
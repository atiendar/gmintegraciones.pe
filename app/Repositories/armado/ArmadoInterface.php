<?php
namespace App\Repositories\armado;

interface ArmadoInterface {
    public function armadoAsignadoFindOrFailById($id_armado, $clon);
    
    public function getPagination($request, $clon);

    public function store($request);

    public function update($request, $id_armado, $clon);

    public function destroy($id_armado, $clon);

    public function getArmadosFindOrFail($ids_armados, $hastaC);
    
    public function getProductosProveedor($armado, $request);

    public function getImagenesArmado($armado);
    
    public function getArmadoFindOrFail($id_armado);

    public function getAllArmadosPlunk();

    public function getAllArmadosPlunkMenos($armados);

    public function calcularNuevosValoresDelArmado($producto, $nuev_alto, $nuev_ancho, $nuev_largo, $nuev_prec_clien, $nuev_pes);
}
<?php
namespace App\Repositories\armado\clonArmado;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
// Otros
use DB;

class ClonArmadoRepositories implements ClonArmadoInterface {
  protected $armadoRepo;
  public function __construct(ArmadoRepositories $armadoRepositories) {
    $this->armadoRepo        = $armadoRepositories;
  }
  public function store($id_armado) {
    try { DB::beginTransaction();
      $armado                  = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '0', 'productos');
      $armado->num_clon        += 1;
      $clon_armado             = $armado->replicate();
      $clon_armado->img_rut    = null;
      $clon_armado->img_nom    = null;
      $clon_armado->clon       = '1';
      $clon_armado->nom        .= ' - clon' .  $armado->num_clon;
      $clon_armado->sku        .= ' - clon' .  $armado->num_clon;
      $armado->save();
      $clon_armado->save();
      $clon_armado->productos()->sync($armado->productos()->pluck('armado_tiene_productos.id'));
      DB::commit();
      return $clon_armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
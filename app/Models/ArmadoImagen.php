<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ArmadoImagen extends Model {
  protected $table='armado_tiene_imagenes';
  protected $primaryKey='id';
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
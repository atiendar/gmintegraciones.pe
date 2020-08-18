<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioEquipo extends Model {
  use SoftDeletes;
  protected $table = 'inventario_equipos';
  protected $primaryKey = 'id';

  public function archivos() {
    return $this->hasMany('App\Models\InventarioEquipoArchivo')->orderBy('id', 'DESC');
  }

  public function historiales() {
    return $this->hasMany('App\Models\Historial')->orderBy('id', 'DESC');
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
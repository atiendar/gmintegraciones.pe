<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soporte extends Model{
  use SoftDeletes;
  protected $table = 'soportes';
  protected $primaryKey = 'id';

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function archivos() {
    return $this->hasMany('App\Models\SoporteArchivo')->orderBy('id', 'DESC');
  }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Soporte extends Model{
  protected $table = 'soportes';
  protected $primaryKey = 'id';
  protected $guarded = [];

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
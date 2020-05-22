<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QuejaYSugerencia extends Model {
  protected $table = 'quejas_y_sugerencias';
  protected $primaryKey = 'id';

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function usuario(){
    return $this->belongsTo('App\User', 'user_id')->orderBy('id','DESC');
  }
  public function archivos() {
    return $this->hasMany('App\Models\QuejaYSugerenciaArchivo')->orderBy('id', 'DESC');
  }
}
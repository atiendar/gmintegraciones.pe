<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatoFiscal extends Model{
  use SoftDeletes;
  protected $table='datos_fiscales';
  protected $primaryKey='id';

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function usuario(){
    return $this->belongsTo('App\User', 'user_id')->orderBy('id','DESC');
  }
}
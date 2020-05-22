<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model{
  use SoftDeletes;
  protected $table='cotizaciones';
  protected $primaryKey='id';
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null){
      return $query->where('asignado_cot', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function scopeEstatus($query, $estatus) {
    if($estatus != null) {
      return $query->where('estat', $estatus);
    }
  }
  public function cliente(){
    return $this->belongsTo('App\User', 'user_id')->orderBy('id', 'DESC');
  }
  public function armados() {
    return $this->hasMany('App\Models\CotizacionArmado')->orderBy('id', 'DESC');
  }
}
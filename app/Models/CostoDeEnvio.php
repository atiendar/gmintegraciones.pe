<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostoDeEnvio extends Model {
  // use SoftDeletes;
  protected $table='costos_de_envio';
  protected $primaryKey='id';

  public function scopeMetodoDeEntrega($query, $metodo_de_entrega) {
    if($metodo_de_entrega != null) {
      return $query->orWhere('met_de_entreg', 'LIKE', "%$metodo_de_entrega%");
    } else {
      return $query->orWhere('id', '!"#$%&/()(/&%$');
    }
  }
  public function scopeEstado($query, $estado) {
    if($estado != null) {
      return $query->orWhere('est', 'LIKE', "%$estado%");
    } else {
      return $query->orWhere('id', '!"#$%&/()(/&%$');
    }
  }
  public function scopeTipoDeEnvio($query, $tipo_de_envio) {
    if($tipo_de_envio != null) {
      return $query->orWhere('tip_env', 'LIKE', "%$tipo_de_envio%");
    } else {
      return $query->orWhere('id', '!"#$%&/()(/&%$');
    }
  }
}
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
      return $query->where('met_de_entreg', 'LIKE', "%$metodo_de_entrega%");
    }
  }
  public function scopeEstado($query, $estado) {
    if($estado != null) {
      return $query->where('est', 'LIKE', "%$estado%");
    }
  }
  public function scopeTipoDeEnvio($query, $tipo_de_envio) {
    if($tipo_de_envio != null) {
      return $query->where('tip_env', 'LIKE', "%$tipo_de_envio%");
    }
  }
  public function scopeSinSeleccion($query, $metodo_de_entrega, $estado, $tipo_de_envio) {
    if($metodo_de_entrega == null AND $estado == null AND $tipo_de_envio == null) {
      return $query->where('id', '!"#$%&/()(/&%$');
    }
  }
}
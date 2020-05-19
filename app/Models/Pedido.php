<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model{
  use SoftDeletes;
  protected $table='pedidos';
  protected $primaryKey='id';

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_ped', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  } 
  public function usuario() {
    return $this->belongsTo('App\User', 'user_id')->orderBy('id','DESC');
  }
  public function unificar() {
    return $this->belongsToMany('App\Models\Pedido', 'pedidos_unificados', 'pedido_id', 'unificado_id')->withPivot('id')->withTimestamps()->orderBy('pedidos_unificados.id', 'DESC');
  }
  public function armados() {
    return $this->hasMany('App\Models\PedidoArmado')->orderBy('id', 'DESC');
  }  
  public function pago() {
    return $this->hasOne('App\Models\Pago')->orderBy('id', 'DESC');
  }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoArmadoProductoTieneSustituto extends Model {
  // use SoftDeletes;
  protected $table='pedido_armado_producto_tiene_sustitutos';
  protected $primaryKey='id';

  public function producto(){
    return $this->belongsTo('App\Models\PedidoArmadoTieneProducto')->orderBy('id', 'DESC');
  }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoArmadoTieneDireccion extends Model {
  use SoftDeletes;
  protected $table='pedido_armado_tiene_direcciones';
  protected $primaryKey='id';
  
  public function armado() {
    return $this->belongsTo('App\Models\PedidoArmado','pedido_armado_id')->orderBy('id','DESC');
  }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoArmado extends Model{
  use SoftDeletes;
  protected $table = 'pedido_armados';
  protected $primaryKey = 'id';

  public function comprobantesDeEntrega() {
    return $this->hasMany('App\Models\PedidoComprobanteDeEntrega')->orderBy('id', 'DESC');
  }  
  public function pedido() {
    return $this->belongsTo('App\Models\Pedido')->orderBy('id','DESC');
  }
  public function direcciones() {
    return $this->hasMany('App\Models\PedidoArmadoTieneDireccion', 'pedido_armado_id')->orderBy('id','DESC');
  }
  public function productos() {
    return $this->hasMany('App\Models\PedidoArmadoTieneProducto', 'pedido_armado_id')->orderBy('id','DESC');
  }
}
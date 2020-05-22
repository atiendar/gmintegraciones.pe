<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoArmadoTieneProducto extends Model{
  use SoftDeletes;
  protected $table='pedido_armado_tiene_productos';
  protected $primaryKey='id';
  public function armados(){
    return $this->belongsTo('App\Models\PedidoArmado', 'pedido_armado_id')->orderBy('id', 'DESC');
  } 
}
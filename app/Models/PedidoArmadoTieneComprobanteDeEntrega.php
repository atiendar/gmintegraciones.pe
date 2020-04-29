<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoArmadoTieneComprobanteDeEntrega extends Model{
  use SoftDeletes;
  protected $table='pedido_armado_tiene_comprobantes_de_ent';
  protected $primaryKey='id';
  
  public function armado(){
    return $this->belongsTo('App\Models\PedidoArmado')->orderBy('id','DESC');
  }
}
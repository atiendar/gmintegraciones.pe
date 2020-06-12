<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoArmadoDireccionTieneComprobanteDeEntrega extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='pedido_armado_direc_tiene_com_de_ent';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
 // protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function direccion(){
    return $this->belongsTo('App\Models\PedidoArmadoTieneDireccion')->orderBy('id', 'DESC');
  }
}
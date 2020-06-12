<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoArmadoTieneDireccion extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='pedido_armado_tiene_direcciones';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['comprobantesDeEntrega']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function armado() {
    return $this->belongsTo('App\Models\PedidoArmado', 'pedido_armado_id')->orderBy('id','DESC');
  }
  public function comprobantesDeEntrega() {
    return $this->hasMany('App\Models\PedidoArmadoDireccionTieneComprobanteDeEntrega', 'direccion_id')->orderBy('id', 'DESC');
  } 
}
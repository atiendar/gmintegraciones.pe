<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model{
  use SoftDeletes;
  protected $table='pagos';
  protected $primaryKey='id';

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function usuario(){
    return $this->belongsTo('App\Models\User')->orderBy('id','DESC');
  } 
  public function pedido(){
    return $this->belongsTo('App\Models\Pedido')->orderBy('id','DESC');
  }
  public function factura(){
    return $this->hasOne('App\Models\Factura');
  } 
}

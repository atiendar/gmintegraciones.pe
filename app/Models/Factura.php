<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model{
  use SoftDeletes;
  protected $table='facturas';
  protected $primaryKey='id';
  
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function pago(){
    return $this->belongsTo('App\Models\Pago');
  }
}
